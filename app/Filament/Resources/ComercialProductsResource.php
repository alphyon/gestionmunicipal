<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComercialProdcutsResource\Pages;
use App\Filament\Resources\ComercialProdcutsResource\RelationManagers;
use App\Models\ComercialProducts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComercialProductsResource extends Resource
{
    protected static ?string $model = ComercialProducts::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Administración General';
    protected static ?string $label = 'categoria venta';
    protected static ?string $pluralLabel = 'categorias ventas';
    protected static ?int $navigationSort=3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ManageComercialProdcuts::route('/'),
        ];
    }
}
