<?php

namespace App\Filament\Resources\TaxDeclarationResource\Pages;

use App\Filament\Resources\TaxDeclarationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTaxDeclarations extends ManageRecords
{
    protected static string $resource = TaxDeclarationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
