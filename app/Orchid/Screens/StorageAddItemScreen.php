<?php

namespace App\Orchid\Screens;

use App\Http\Controllers\JobsController;
use App\Models\Job;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StorageAddItemScreen extends Screen
{
    protected Job|null $job = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->bussinessAccount) {
                abort(403);
            }
            return $next($request);
        });
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->job = app(JobsController::class)->show(request()->route('id'));
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Job Create';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create Job')
                ->method('create')
                ->confirm('Are you sure you want to create this job?')
                ->icon('plus')
                ->canSee((bool)auth()->user()->bussinessAccount && !$this->job),
            Button::make('Update Job')
                ->method('update')
                ->confirm('Are you sure you want to update the information of this job?')
                ->icon('pencil')
                ->canSee( $this->job && auth()->user()->bussinessAccount()->where('id', $this->job->bussiness_account_id)->exists()),
            Button::make('Delete Job')
                ->method('delete')
                ->novalidate()
                ->confirm('Are you sure you want to delete of this job?')
                ->icon('trash')
                ->type(Color::DANGER)
                ->canSee( $this->job && auth()->user()->bussinessAccount()->where('id', $this->job->bussiness_account_id)->exists()),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('id')->title('ID')->readonly()->value($this->job?->id)->canSee((bool)$this->job),
                Input::make('title')->title('Title')
                    ->placeholder('Enter job title')
                    ->value($this->job?->title)
                    ->required(),
                Input::make('position')->title('Position')->placeholder('Enter job position')
                    ->value($this->job?->position)->required(),
                TextArea::make('description')->title('Description')
                    ->value($this->job?->description)
                    ->placeholder('Enter job description')
                    ->rows(4),
                Select::make('type')->title('Type')
                    ->options([
                        'fulltime' => 'Full Time',
                        'parttime' => 'Part Time',
                        'internship' => 'Internship',
                        'freelance' => 'Freelance',
                        'temporary' => 'Temporary',
                    ])->required()
                ->value($this->job?->type),
                Select::make('experience_required')->title('Experience Required')
                ->options([
                    '' => 'None',
                    '1 Year' => '1 Year',
                    '3-5 Years' => '3-5 Years',
                    '5-10 Years' => '5-10 Years',
                    '10+ Years' => '10+ Years',
                ])->required()
                ->value($this->job?->experience_required),
                Input::make('end_date')->title('End Date')->placeholder('Enter end date')
                    ->type('date')->required()
                ->value($this->job?->end_date),
                Select::make('bussiness_account_id')
                    ->options(\App\Models\BussinessAccount::where('user_id', auth()->user()->id)->get()->pluck('name', 'id'
                    )->toArray())
                ->title('Company Name')
                ->required()
                ->value($this->job?->bussiness_account_id),
            ]),
        ];
    }

    public function create() {
        app(JobsController::class)->store();
        return redirect()->route('platform.storage');
    }

    public function update() {
        app(JobsController::class)->update(request()->route('id'));
        return redirect()->route('platform.storage');
    }

    public function delete() {
        app(JobsController::class)->destroy(request()->route('id'));
        return redirect()->route('platform.storage');
    }
}
