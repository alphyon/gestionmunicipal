<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnerResource\Pages;
use App\Filament\Resources\OwnerResource\RelationManagers;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OwnerResource extends Resource
{
    protected static ?string $model = Owner::class;

    protected static ?string $navigationIcon = 'mdi-account-card-outline';
    protected static ?string $navigationGroup = 'Administración General';
    protected static ?string $label = 'Propietario';
    protected static ?string $pluralLabel = 'Propietarios';
    protected static ?int $navigationSort=0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('Nombres')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->label('Apellidos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('AKA')
                    ->label('Conocido por:')
                    ->maxLength(255),
                Forms\Components\Select::make('doc_type')
                    ->label('Tipo de Documento')
                    ->options([
                        'dui'=>"DUI",
                        'nit'=>"NIT",
                        'passport'=>"Pasaporte",
                    ])->native(false)
                    ->required(),
                Forms\Components\TextInput::make('document')
                    ->label('Número de documento')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('isr')
                    ->label('Declara impuestos')
                    ->required(),
                Forms\Components\Hidden::make('status')
                    ->label('Estado')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('#')->rowIndex(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document')
                    ->label('Documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ManageOwners::route('/'),
        ];
    }
}
