<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Avenue;
use App\Models\Colony;
use App\Models\Company;
use App\Models\Passage;
use App\Models\Street;
use App\Models\Zone;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'mdi-factory';
    protected static ?string $navigationGroup = 'Cobros';
    protected static ?string $label = 'empresa';
    protected static ?string $pluralLabel = 'empresas';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Generalidad')->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('commercial_name')
                        ->label('Nombre Comercial')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('commercial_activity')
                        ->label('Actividad')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('operation_start')
                        ->required(),
                    Forms\Components\TextInput::make('type')
                        ->label('Tipo')
                        ->required()
                        ->maxLength(255),
                ]),
                Forms\Components\Fieldset::make('registros')->schema([
                    Forms\Components\TextInput::make('file')
                        ->label('Archivo')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('NRC')
                        ->label('NRC')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('NIT')
                        ->label('NIT')
                        ->required()
                        ->maxLength(255),
                ]),
                Forms\Components\Fieldset::make('Contacto')->schema([
                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                ]),


                Forms\Components\Fieldset::make('group_location')->schema([
                    Forms\Components\Textarea::make('address')
                        ->columnSpanFull()
                        ->label('Dirección')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('zone')
                        ->label('Zona')
                        ->options(Zone::all()->pluck('name', 'id'))
                        ->native(false)
                        ->required(),
                    Forms\Components\Select::make('street')
                        ->label('Calle')
                        ->options(Street::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('avenue')
                        ->label('Avenida')
                        ->options(Avenue::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('colony')
                        ->label('Colonia')
                        ->options(Colony::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('passage')
                        ->label('Pasaje')
                        ->options(Passage::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\TextInput::make('block')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('number_house')
                        ->label('Numero')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('reference')
                        ->label('complemento')
                        ->columnSpanFull(),

                ])->label('Localización'),

                Forms\Components\Fieldset::make('otros')->schema([
                    Forms\Components\Toggle::make('declare')
                        ->label('Declara Impuestos')
                        ->required(),
                    Forms\Components\Toggle::make('status')
                        ->label('Activo')
                        ->default(true)
                        ->required(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NIT')
                    ->label('NIT')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefono')
                    ->searchable(),
                Tables\Columns\IconColumn::make('declare')
                    ->label('declara')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modificado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TaxableRelationManager::class,
            RelationManagers\DeclarationsRelationManager::class,
            RelationManagers\LegalsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
