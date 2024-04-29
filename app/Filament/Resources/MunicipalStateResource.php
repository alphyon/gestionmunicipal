<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipalStateResource\Pages;
use App\Filament\Resources\MunicipalStateResource\RelationManagers;
use App\Models\MunicipalState;
use App\Models\Zone;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MunicipalStateResource extends Resource
{
    protected static ?string $model = MunicipalState::class;

    protected static ?string $navigationIcon = 'mdi-store-outline';
    protected static ?string $navigationGroup = 'Administración General';
    protected static ?string $label = 'Inmueble municipal';
    protected static ?string $pluralLabel = 'Inmuebles municipales';
    protected static ?int $navigationSort=1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('zone')
                    ->options(Zone::pluck('name', 'id'))
                    ->label('Zona'),
                Forms\Components\Textarea::make('address')
                    ->label('Dirección')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('manager')
                    ->label('Gerente')
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->label('Activo')
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Activo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('manager')
                    ->label('Gerente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zone')
                    ->label('Zona')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMunicipalStates::route('/'),
        ];
    }
}
