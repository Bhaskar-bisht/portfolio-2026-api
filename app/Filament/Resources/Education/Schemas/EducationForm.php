<?php

namespace App\Filament\Resources\Education\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('institution_name')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                TextInput::make('degree')
                    ->required(),
                TextInput::make('field_of_study')
                    ->default(null),
                TextInput::make('grade')
                    ->default(null),
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                TextInput::make('credential_url')
                    ->url()
                    ->default(null),
                TextInput::make('certificate_url')
                    ->url()
                    ->default(null),
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
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),

            ]);
    }
}
