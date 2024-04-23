<?php

namespace App\Filament\Resources\CategoryTaxResource\Pages;

use App\Filament\Resources\CategoryTaxResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategoryTaxes extends ManageRecords
{
    protected static string $resource = CategoryTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
