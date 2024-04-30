<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeclarationsRelationManager extends RelationManager
{
    protected static string $relationship = 'taxDeclaration';
    protected static ?string $label='declaracion de impuesto';
    protected static ?string $pluralLabel='declaraciones de impuestos';
    protected static ?string $title = 'declaraciones de impuesto';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('net_assets')
                    ->label('Activos')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('net_assets_taxable')
                    ->label('Impuestos Activos')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('monthly_amount_tax')
                    ->label('Impuestos emnsuales ')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('date_record')
                    ->label('Fecha de declaracíon')
                    ->native(false)
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->offIcon('mdi-cash-remove')
                    ->onIcon('mdi-cash-check')
                    ->label('Pagado')->inline()
            ])->columns(1);

    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('company_id')
            ->columns([
                Tables\Columns\TextColumn::make('date_record')->label('Fecha Declación'),
                Tables\Columns\IconColumn::make('status')
                    ->label('Pagado')
                    ->trueIcon('mdi-cash-check')
                    ->trueColor('success')
                    ->falseIcon('mdi-cash-remove')
                    ->falseColor('danger')
                    ->boolean(),
                Tables\Columns\TextColumn::make('net_assets')->label('Activos')->money('USD'),
                Tables\Columns\TextColumn::make('net_assets_taxable')->label('Impuestos actvios')->money('USD'),
                Tables\Columns\TextColumn::make('monthly_amount_tax')
                    ->label('impuesto mensual')->money('USD'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function ($data){
                    $data['district_id'] =Filament::getTenant()->id;
                    return $data;
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
