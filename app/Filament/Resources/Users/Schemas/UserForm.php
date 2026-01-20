<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Textarea::make('bio')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('tagline')
                    ->default(null),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password(),
                TextInput::make('current_position')
                    ->default(null),
                TextInput::make('years_of_month')
                    ->required()
                    ->numeric()
                    ->default(0),
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->collection('avatar')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                SpatieMediaLibraryFileUpload::make('user_resume')
                    ->collection('resume')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                TextInput::make('years_of_experience')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('location')
                    ->default(null),
                TextInput::make('timezone')
                    ->required()
                    ->default('UTC'),
                Select::make('availability_status')
                    ->options(['available' => 'Available', 'busy' => 'Busy', 'not_looking' => 'Not looking'])
                    ->default('available')
                    ->required(),
                TextInput::make('github_url')
                    ->url()
                    ->default(null),
                TextInput::make('linkedin_url')
                    ->url()
                    ->default(null),
                TextInput::make('twitter_url')
                    ->url()
                    ->default(null),
                TextInput::make('behance_url')
                    ->url()
                    ->default(null),
                TextInput::make('dribbble_url')
                    ->url()
                    ->default(null),
            ]);
    }
}
