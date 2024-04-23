<?php

namespace App\Filament\Resources\ComercialProdcutsResource\Pages;

use App\Filament\Resources\ComercialProdcutsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageComercialProdcuts extends ManageRecords
{
    protected static string $resource = ComercialProdcutsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
