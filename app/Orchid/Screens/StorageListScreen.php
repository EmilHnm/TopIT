<?php

namespace App\Orchid\Screens;

use App\Http\Controllers\JobsController;
use App\Models\Job;
use Carbon\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class StorageListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $savedJobs = app(JobsController::class)->index();
//        dd($savedJobs);
        return [
            'job' => $savedJobs
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Job List';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create Job')
                ->route('platform.storage.add')
                ->icon('plus')
            ->canSee((bool)auth()->user()->bussinessAccount)
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
            Layout::table('job', [
                TD::make('', 'Company Name')->render(function (Job $job) {
                    return "<strong>{$job->position}</strong><br>
                            <small>{$job->poster->name}</small>";
                }),
                TD::make('description', 'Description')->render(function (Job $job) {
                    return \Str::limit($job->description, 100);
                }),
                TD::make('', 'Address')->render(function (Job $job) {
                    return $job->poster->address;
                }),
                TD::make('', 'Scout In')->render(function (Job $job) {
                    $start = $job->created_at?->format('d/m/Y') ?? Carbon::now()->toDateString();
                    return "From: <strong>{$start}</strong><br>
                            To: <strong>{$job->end_date}</strong>";
                }),
                TD::make('')->render(function (Job $job) {
                    return Link::make('View')
                        ->route('platform.storage.view', $job->id)
                        ->icon('eye').
                        Link::make('Edit')->icon('pencil')
                            ->canSee(auth()->user()->bussinessAccount()->where('id', $job->bussiness_account_id)->exists())
                            ->route('platform.storage.edit', $job->id).
                        Button::make('Apply')->icon('check')
                            ->canSee(!auth()->user()->bussinessAccount()->where('id', $job->bussiness_account_id)->exists())
                            ->method('apply')
                            ->confirm('Are you sure you want to apply for this job?')
                            ->parameters([
                                'id' => $job->id
                            ]);
                }),
            ]),
        ];
    }

    public function apply($id) {
        dd($id);
    }
}
