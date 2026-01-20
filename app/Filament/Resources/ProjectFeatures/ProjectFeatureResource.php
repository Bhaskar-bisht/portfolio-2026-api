<?php

namespace App\Filament\Resources\ProjectFeatures;

use App\Filament\Resources\ProjectFeatures\Pages\CreateProjectFeature;
use App\Filament\Resources\ProjectFeatures\Pages\EditProjectFeature;
use App\Filament\Resources\ProjectFeatures\Pages\ListProjectFeatures;
use App\Filament\Resources\ProjectFeatures\Schemas\ProjectFeatureForm;
use App\Filament\Resources\ProjectFeatures\Tables\ProjectFeaturesTable;
use App\Models\ProjectFeature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProjectFeatureResource extends Resource
{
    protected static ?string $model = ProjectFeature::class;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ProjectFeatureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectFeaturesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectFeatures::route('/'),
            'create' => CreateProjectFeature::route('/create'),
            'edit' => EditProjectFeature::route('/{record}/edit'),
        ];
    }
}
