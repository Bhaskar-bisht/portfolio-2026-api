<?php

namespace App\Filament\Resources\Technologies\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TechnologyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make(name: 'featured_image')
                    ->collection('logo')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                Select::make('category')
                    ->options([
                        'language' => 'Language',
                        'library' => 'Library',
                        'framework' => 'Framework',
                        'tool' => 'Tool',
                        'database' => 'Database',
                        'devops' => 'Devops',
                        'other' => 'Other',
                    ])
                    ->default('other')
                    ->required(),
                Select::make('proficiency_level')
                    ->options(['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'expert' => 'Expert'])
                    ->default(null),
                TextInput::make('years_of_experience')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('color_code')
                    ->default(null),
                TextInput::make('background_color')
                    ->default(null),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('documentation_url')
                    ->url()
                    ->default(null),
                TextInput::make('official_url')
                    ->url()
                    ->default(null),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
