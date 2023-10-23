<?php

namespace App\Orchid\Screens;

use App\Http\Controllers\JobsController;
use App\Models\Job;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class StorageItemScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

//        dd(app(JobsController::class)->show(request()->route('id'))->poster);
        return [
            'job' => app(JobsController::class)->show(request()->route('id')),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Job Details';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('job', [
                Sight::make('title'),
                Sight::make('position'),
                Sight::make('description'),
                Sight::make('type'),
            ])->title('Job'),
            Layout::legend('job', [
                Sight::make('', 'Name')->render(function (Job $job) {
                    return "<strong>{$job->poster->name}</strong><br>
                            <small>{$job->poster->root?->email}</small>";
                }),
                Sight::make('', 'Introduce')->render(function (Job $job) {
                    return "<span>{$job->poster->introduce}</span>";
                }),
                Sight::make('', 'Phone')->render(function (Job $job) {
                    return "<span>{$job->poster->phone}</span>";
                }),
                Sight::make('', 'Address')->render(function (Job $job) {
                    return "<span>{$job->poster->address}</span>". Link::make('View on map')
                        ->href('https://www.google.com/maps/search/?api=1&query='.$job->poster->address)
                            ->target('_blank')
                        ->icon('map');
                }),
                Sight::make()->render(function (Job $job) {
                    return Link::make('See more')
//                        ->route('platform.systems.users.edit', $job->poster->id)
                        ->icon('eye');
                }),
            ])->title('Work At')
        ];
    }
}
