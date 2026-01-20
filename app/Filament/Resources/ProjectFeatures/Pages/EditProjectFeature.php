<?php

namespace App\Filament\Resources\ProjectFeatures\Pages;

use App\Filament\Resources\ProjectFeatures\ProjectFeatureResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectFeature extends EditRecord
{
    protected static string $resource = ProjectFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
