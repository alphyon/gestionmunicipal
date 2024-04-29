<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\Avenue;
use App\Models\Colony;
use App\Models\Owner;
use App\Models\Passage;
use App\Models\State;
use App\Models\Street;
use App\Models\Zone;
use Carbon\Carbon;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'mdi-home-city-outline';
    protected static ?string $navigationGroup = 'Cobros';
    protected static ?string $label = 'inmueble';
    protected static ?string $pluralLabel = 'inmuebles';
    protected static ?int $navigationSort=0;
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
                Forms\Components\Fieldset::make('Administración municipal')->schema([
                    Forms\Components\Select::make('type')
                        ->label('Tipo de uso')
                        ->native(false)
                        ->options([
                            'commercial' => 'Comercial',
                            'habitat' => 'Habitacional',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('code')
                        ->label('Codigo')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('NIS')
                        ->label('NIS')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('file')
                        ->label('Número de Archivo')
                        ->maxLength(255),
                ]),

                Forms\Components\Fieldset::make('Datos de Ubicación')->schema([
                    Forms\Components\Select::make('zone')
                        ->label('Zona')
                        ->options(Zone::all()->pluck('name', 'id'))
                        ->native(false)
                        ->required(),

                    Forms\Components\Select::make('street')
                        ->label('Calle')
                        ->options(Street::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('avenue')
                        ->label('Avenida')
                        ->options(Avenue::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('colony')
                        ->label('Colonia')
                        ->options(Colony::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('passage')
                        ->label('Pasaje / Barrio')
                        ->options(Passage::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\TextInput::make('block')
                        ->label('Bloque')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('number_house')
                        ->label('Número de casa')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('reference')
                        ->label('Referencia/ Complemento dirección')
                        ->columnSpanFull(),
                ]),

                Map::make('location')
                    ->label('Ubicación mapa')
                    ->columnSpanFull()
                    ->mapControls([
                        'mapTypeControl'    => false,
                        'scaleControl'      => true,
                        'streetViewControl' => true,
                        'rotateControl'     => true,
                        'fullscreenControl' => true,
                        'searchBoxControl'  => false, // creates geocomplete field inside map
                        'zoomControl'       => false,
                    ])
                    ->height(fn () => '400px') // map height (width is controlled by Filament options)
                    ->defaultZoom(20) // default zoom level when opening form
                    ->autocomplete('full_address') // field on form to use as Places geocompletion field
                    ->autocompleteReverse(true) // reverse geocode marker location to autocomplete field
                    ->reverseGeocode([
                        'street' => '%n %S',
                        'city' => '%L',
                        'state' => '%A1',
                        'zip' => '%z',
                    ]) // reverse geocode marker location to form fields, see notes below
                    ->debug() // prints reverse geocode format strings to the debug console
                    ->defaultLocation([13.4984111785888670, -89.0291366577148]) // default for new forms
                    ->draggable() // allow dragging to move marker
                    ->clickable(false) // allow clicking to move marker
                    ->geolocate() // adds a button to request device location and set map marker accordingly
//                    ->geolocateLabel('Get Location') // overrides the default label for geolocate button
//                    ->geolocateOnLoad(true, false) // geolocate on load, second arg 'always' (default false, only for new form))
//                    ->layers([
//                        'https://googlearchive.github.io/js-v2-samples/ggeoxml/cta.kml',
//                    ]) // array of KML layer URLs to add to the map
//                    ->geoJson('https://fgm.test/storage/AGEBS01.geojson') // GeoJSON file, URL or JSON
//                    ->geoJsonContainsField('geojson')
                   ,

                Forms\Components\Fieldset::make('Datos complementarios')->schema([
                    Forms\Components\DatePicker::make('register')
                        ->label('Fecha registrda')
                        ->native(false)
                        ->maxDate(now())
                        ->weekStartsOnMonday()
                        ->required(),
                    Forms\Components\TextInput::make('measure')
                        ->label(new HtmlString('Medida en m<sup>2</sup>'))
                        ->required()
                        ->numeric()->suffix(new HtmlString('m<sup>2</sup>')),
                    Forms\Components\Toggle::make('status')
                        ->default(true)
                        ->required(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('owner.full_name')
                    ->label('Dueño'),
                Tables\Columns\TextColumn::make('zone')
                    ->label('Zona')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')
                    ->label('Calle')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('avenue')
                    ->label('Avenida')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('colony')
                    ->label('Colonia / Barrio')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('measure')
                    ->label(new HtmlString('Medida en m<sup>2</sup>'))
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
