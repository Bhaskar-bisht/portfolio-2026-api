<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('certificate')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('awarded_by')
                    ->default(null),
                DatePicker::make('award_date'),
                TextInput::make('award_url')
                    ->url()
                    ->default(null),
                Select::make('achievement_type')
                    ->options([
                        'award' => 'Award',
                        'recognition' => 'Recognition',
                        'publication' => 'Publication',
                        'other' => 'Other',
                    ])
                    ->default('award')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
