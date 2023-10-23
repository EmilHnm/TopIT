<?php

namespace App\Orchid\Screens;

use App\Models\BussinessAccount;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class CompanyListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $company = BussinessAccount::paginate();
        return [
            'company' => $company
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'CompanyListScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

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
            Layout::table('company', [
                TD::make('name', 'Company Name')->render(function (BussinessAccount $company) {
                    return "<strong>{$company->name}</strong><br>
                            <small>{$company->phone}</small><br>
                            <a href='http://www.{$company->website}' target='_blank'>{$company->website}</a>";
                }),
                TD::make('introduce', 'Introduce')->render(function (BussinessAccount $company) {
                    return "<p style='max-width: 500px; line-break: normal'>{$company->introduce}</p>" ;
                }),
                TD::make('address', 'Address'),
            ])
        ];
    }
}
