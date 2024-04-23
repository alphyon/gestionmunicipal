<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaxDeclarationResource\Pages;
use App\Filament\Resources\TaxDeclarationResource\RelationManagers;
use App\Models\TaxDeclaration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaxDeclarationResource extends Resource
{
    protected static ?string $model = TaxDeclaration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('net_assets')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('net_assets_taxable')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('monthly_amount_tax')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_record')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_assets')
                    ->searchable(),
                Tables\Columns\TextColumn::make('net_assets_taxable')
                    ->searchable(),
                Tables\Columns\TextColumn::make('monthly_amount_tax')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_record')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
            'index' => Pages\ManageTaxDeclarations::route('/'),
        ];
    }
}
