<?php
namespace App\Filament\Pages\Tenancy;
use App\Models\District;
use Filament\Forms\Components\Select;
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
            ->label('Nombre del distrito')
                ->autocomplete()
            ->datalist(District::all()->pluck('name'))
        ]);
    }

    protected function handleRegistration(array $data): \Illuminate\Database\Eloquent\Model
    {

        $district = District::firstOrCreate($data);
        $district->members()->attach(auth()->user());
        return $district;
    }
}
