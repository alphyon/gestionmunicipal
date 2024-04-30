<?php

namespace App\Filament\Resources\SpotResource\Pages;

use App\Filament\Resources\SpotResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSpots extends ManageRecords
{
    protected static string $resource = SpotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->mutateFormDataUsing(function (array $data) {
                $data['district_id'] = filament()->getTenant()->id;
                return $data;
            }),
        ];
    }
}
