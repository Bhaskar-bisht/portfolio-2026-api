<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('company_name')
                    ->required(),
                TextInput::make('position')
                    ->required(),
                Select::make('employment_type')
                    ->options([
                        'full_time' => 'Full time',
                        'part_time' => 'Part time',
                        'contract' => 'Contract',
                        'freelance' => 'Freelance',
                    ])
                    ->default('full_time')
                    ->required(),
                TextInput::make('location')
                    ->default(null),
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                Toggle::make('is_remote')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                Toggle::make('is_current')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('achievements')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('company_url')
                    ->url()
                    ->default(null),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
