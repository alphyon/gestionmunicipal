<?php
namespace App\Filament\Pages\Tenancy;
use App\Models\District;
use Filament\Forms\Components\TextInput;

class RegisterDistrict extends \Filament\Pages\Tenancy\RegisterTenant
{

    public static function getLabel(): string
    {
        return 'Registrar distritos';
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            TextInput::make('name')
        ]);
    }

    protected function handleRegistration(array $data): \Illuminate\Database\Eloquent\Model
    {
        $district = District::create($data);
        $district->members()->attach(auth()->user());
        return $district;
    }
}
