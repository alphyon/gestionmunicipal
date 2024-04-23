<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commercial_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commercial_activity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('file')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('NRC')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('NIT')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('avenue')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('passage')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('colony')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('block')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('num_house')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('operation_start')
                    ->required(),
                Forms\Components\Toggle::make('declare')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commercial_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commercial_activity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NRC')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NIT')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('avenue')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('passage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('colony')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('block')
                    ->searchable(),
                Tables\Columns\TextColumn::make('num_house')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('operation_start')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('declare')
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
            'index' => Pages\ManageCompanies::route('/'),
        ];
    }
}
