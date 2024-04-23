<?php

namespace App\Filament\Resources\TaxAssingResource\Pages;

use App\Filament\Resources\TaxAssingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTaxAssings extends ManageRecords
{
    protected static string $resource = TaxAssingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
