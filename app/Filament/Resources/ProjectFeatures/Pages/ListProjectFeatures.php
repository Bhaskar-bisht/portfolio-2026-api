<?php

namespace App\Filament\Resources\ProjectFeatures\Pages;

use App\Filament\Resources\ProjectFeatures\ProjectFeatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectFeatures extends ListRecords
{
    protected static string $resource = ProjectFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
