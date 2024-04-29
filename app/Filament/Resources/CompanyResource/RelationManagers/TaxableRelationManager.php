<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaxableRelationManager extends RelationManager
{
    protected static string $relationship = 'taxable';
    protected static ?string $label = 'Tasa';
    protected static ?string $pluralLabel='Tasas';

    protected static ?string $title = 'Tasas asignables';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('fee_id')
                    ->label('Tasa')
                    ->relationship('fee','name')
                    ->required(),
                Forms\Components\TextInput::make('cycle_days')->required()
                ->label('Ciclo de cobro'),
                Forms\Components\Toggle::make('expiration')->label('expiración(genera mora)')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('taxable_id')
            ->columns([
                Tables\Columns\TextColumn::make('fee.name')->label('Tasa'),
                Tables\Columns\TextColumn::make('fee.quantity')->label('pago')->money('USD'),
                Tables\Columns\TextColumn::make('cycle_days')->label('Ciclo de cobro'),
                Tables\Columns\IconColumn::make('expiration')->label('genera mora')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
