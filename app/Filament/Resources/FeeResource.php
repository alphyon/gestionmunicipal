<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeeResource\Pages;
use App\Filament\Resources\FeeResource\RelationManagers;
use App\Models\Fee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeeResource extends Resource
{
    protected static ?string $model = Fee::class;

    protected static ?string $navigationIcon = 'mdi-hand-coin-outline';
    protected static ?string $navigationGroup = 'Gestion impuestos';
    protected static ?string $label = 'tasa';
    protected static ?string $pluralLabel = 'tasas';
    protected static ?int $navigationSort=2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tax_id')
                    ->relationship('taxes', 'name')
                    ->label('Impuesto')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->label('Cantidad')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('date_init')
                    ->label('Fecha Inicio')
                    ->required(),
                Forms\Components\DatePicker::make('date_end')
                ->label('Fecha Fin'),
                Forms\Components\TextInput::make('period')
                ->label('Periodo'),
                Forms\Components\TextInput::make('adjust')
                    ->label('Ajuste')
                    ->hint('Variacion del impuesto')
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->label('Estado')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('date_init')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_end')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adjust')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tax_id')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFees::route('/'),
        ];
    }
}
