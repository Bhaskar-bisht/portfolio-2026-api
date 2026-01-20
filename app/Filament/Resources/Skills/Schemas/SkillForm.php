<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),
                // TextInput::make('technology_id')
                //     ->required()
                //     ->numeric(),
                Select::make('technology_id')
                    ->label('Technology')
                    ->relationship('technology', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('proficiency_percentage')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('years_of_experience')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_primary_skill')
                    ->required(),
                DatePicker::make('last_used_at'),
                TextInput::make('certification_url')
                    ->url()
                    ->default(null),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
