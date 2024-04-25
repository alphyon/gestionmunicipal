<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryTaxResource\Pages;
use App\Filament\Resources\CategoryTaxResource\RelationManagers;
use App\Models\CategoryTax;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryTaxResource extends Resource
{
    protected static ?string $model = CategoryTax::class;

    protected static ?string $navigationIcon = 'mdi-label-percent';
    protected static ?string $navigationGroup = 'Gestion impuestos';
    protected static ?string $label = 'categoría';
    protected static ?string $pluralLabel = 'categorias';
    protected static ?int $navigationSort=1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->label('activo')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('nombre')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('activo')
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategoryTaxes::route('/'),
        ];
    }
}
