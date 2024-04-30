<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpotResource\Pages;
use App\Filament\Resources\SpotResource\RelationManagers;
use App\Models\Spot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpotResource extends Resource
{
    protected static ?string $model = Spot::class;

    protected static ?string $navigationIcon = 'mdi-garage-open';
    protected static ?string $navigationGroup = 'Cobros';
    protected static ?string $label = 'espacio municpal (puesto)';
    protected static ?string $pluralLabel = 'puestos';
    protected static ?int $navigationSort=2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('owner_id')
                    ->label('Dueño')
                    ->relationship('owner','last_name' )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->full_identification)
                    ->createOptionForm([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Nombres')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Apellidos')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('AKA')
                            ->label('Conocido por')
                            ->maxLength(255),
                        Forms\Components\Select::make('doc_type')
                            ->label('Tipo de documento')
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
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('isr')
                            ->label('Declara Impuestos')
                            ->required(),
                        Forms\Components\Hidden::make('status')
                            ->label('Activo')
                            ->default(true),
                    ])->columnSpanFull()
                    ->native(false)->searchable(),
                Forms\Components\Checkbox::make('have_manager')
                    ->label('Tiene responsable')
                    ->live()
                    ->required(),
                Forms\Components\Grid::make('manager')->schema([
                    Forms\Components\TextInput::make('manager')
                        ->label('responsable')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('manager_document')
                        ->label('# documento responsable')
                        ->maxLength(255),
                ])->hidden(fn (Forms\Get $get): bool => !$get('have_manager')),
                Forms\Components\Select::make('municipal_state_id')
                    ->relationship('municipalState', 'name')
                    ->label('Ubicado en:')
                    ->required(),
                Forms\Components\TextInput::make('reference')
                    ->label('referencia/código/tarjeta')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->label('ubicación')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('measure')
                    ->label('medida')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('status')
                    ->label('Activo')
                    ->default(true)
                    ->required(),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('#')->rowIndex(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('owner.full_name')
                    ->label('Dueño')->wrap(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('measure')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('municipalState.name')
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSpots::route('/'),
        ];
    }
}
