<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('icon')
                    ->default(null),
                Select::make('pricing_type')
                    ->options(['fixed' => 'Fixed', 'hourly' => 'Hourly', 'project_based' => 'Project based'])
                    ->default('project_based')
                    ->required(),
                TextInput::make('starting_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->collection('thumbnail')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                Textarea::make('features')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('delivery_time')
                    ->default(null),
                Toggle::make('is_active')
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
