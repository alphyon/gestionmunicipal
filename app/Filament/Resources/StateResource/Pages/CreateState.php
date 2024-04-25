<?php

namespace App\Filament\Resources\StateResource\Pages;

use App\Filament\Resources\StateResource;
use App\Models\StateOwner;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateState extends CreateRecord
{
    protected static string $resource = StateResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $state = static::getModel()::create($data);
        StateOwner::create([
           'state_id' => $state->id,
           'owner_id' => $state->owner_id,
        ]);
        return $state;
    }



    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
