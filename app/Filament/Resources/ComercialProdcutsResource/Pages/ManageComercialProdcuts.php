<?php

namespace App\Filament\Resources\ComercialProdcutsResource\Pages;

use App\Filament\Resources\ComercialProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageComercialProdcuts extends ManageRecords
{
    protected static string $resource = ComercialProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
