<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form->schema([

            Section::make('')->schema([
                TextInput::make('name'),
                DatePicker::make('startDate'),
                DatePicker::make('endDate'),
                //Toggle::make('active'),
            ])->columns(3),

        ]);
    }
}
