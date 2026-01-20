<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('short_description')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('full_description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('project_type')
                    ->options([
                        'web' => 'Web',
                        'mobile' => 'Mobile',
                        'desktop' => 'Desktop',
                        'design' => 'Design',
                        'other' => 'Other',
                    ])
                    ->default('web')
                    ->required(),
                Select::make('status')
                    ->options(['completed' => 'Completed', 'in_progress' => 'In progress', 'archived' => 'Archived'])
                    ->default('in_progress')
                    ->required(),
                Toggle::make('featured')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('thumbnail_image')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                SpatieMediaLibraryFileUpload::make('banner_image')
                    ->collection('banner')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                SpatieMediaLibraryFileUpload::make('gallery_image')
                    ->collection('gallery')
                    ->preserveFilenames()
                    ->image()
                    ->previewable(true)
                    ->downloadable()
                    ->multiple()
                    ->responsiveImages(),
                TextInput::make('priority')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('client_name')
                    ->default(null),
                Textarea::make('client_feedback')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('project_url')
                    ->url()
                    ->default(null),
                TextInput::make('github_url')
                    ->url()
                    ->default(null),
                TextInput::make('demo_url')
                    ->url()
                    ->default(null),
                DatePicker::make('started_at'),
                DatePicker::make('completed_at'),
                TextInput::make('budget_range')
                    ->default(null),
                TextInput::make('team_size')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('views_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('likes_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_published')
                    ->required(),
                TextInput::make('meta_title')
                    ->default(null),
                Textarea::make('meta_description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
