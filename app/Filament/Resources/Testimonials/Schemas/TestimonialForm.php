<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('testimonial_type')
                    ->options(['client' => 'Client', 'colleague' => 'Colleague', 'manager' => 'Manager'])
                    ->default('client')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('position')
                    ->default(null),
                TextInput::make('company')
                    ->default(null),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->default(5),
                SpatieMediaLibraryFileUpload::make('avatar_image')
                    ->collection('avatar')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                SpatieMediaLibraryFileUpload::make('company_logo_image')
                    ->collection('company_logo')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                TextInput::make('linkedin_url')
                    ->url()
                    ->default(null),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_approved')
                    ->required(),
                TextInput::make('testimoniable_type')
                    ->required(),
                TextInput::make('testimoniable_id')
                    ->required()
                    ->numeric(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
