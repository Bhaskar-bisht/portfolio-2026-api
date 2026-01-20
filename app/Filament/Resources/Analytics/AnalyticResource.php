<?php

namespace App\Filament\Resources\Analytics;

use App\Filament\Resources\Analytics\Pages\CreateAnalytic;
use App\Filament\Resources\Analytics\Pages\EditAnalytic;
use App\Filament\Resources\Analytics\Pages\ListAnalytics;
use App\Filament\Resources\Analytics\Schemas\AnalyticForm;
use App\Filament\Resources\Analytics\Tables\AnalyticsTable;
use App\Models\Analytic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnalyticResource extends Resource
{
    protected static ?string $model = Analytic::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }
    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return AnalyticForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnalyticsTable::configure($table);
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
            'index' => ListAnalytics::route('/'),
            'create' => CreateAnalytic::route('/create'),
            'edit' => EditAnalytic::route('/{record}/edit'),
        ];
    }
}
