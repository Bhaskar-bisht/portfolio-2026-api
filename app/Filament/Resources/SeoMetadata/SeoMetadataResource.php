<?php

namespace App\Filament\Resources\SeoMetadata;

use App\Filament\Resources\SeoMetadata\Pages\CreateSeoMetadata;
use App\Filament\Resources\SeoMetadata\Pages\EditSeoMetadata;
use App\Filament\Resources\SeoMetadata\Pages\ListSeoMetadata;
use App\Filament\Resources\SeoMetadata\Schemas\SeoMetadataForm;
use App\Filament\Resources\SeoMetadata\Tables\SeoMetadataTable;
use App\Models\SeoMetadata;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeoMetadataResource extends Resource
{
    protected static ?string $model = SeoMetadata::class;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-magnifying-glass';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return SeoMetadataForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeoMetadataTable::configure($table);
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
            'index' => ListSeoMetadata::route('/'),
            'create' => CreateSeoMetadata::route('/create'),
            'edit' => EditSeoMetadata::route('/{record}/edit'),
        ];
    }
}
