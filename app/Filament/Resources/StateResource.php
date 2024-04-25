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

                ->relationship('owner','first_name' )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->first_name . ' ' . $record->last_name. ' - '. $record->document)

                    ->createOptionForm([
                    Forms\Components\TextInput::make('first_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('last_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('AKA')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('document')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('doc_type')
                        ->options([
                            'dui'=>"DUI",
                            'nit'=>"NIT",
                            'passport'=>"Pasaporte",
                        ])->native(false)
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Toggle::make('isr')
                        ->required(),
                    Forms\Components\Hidden::make('status')
                        ->default(true),
                ])->columnSpanFull()
                ->native(false)->searchable(),
                Forms\Components\Fieldset::make('group_manage')->schema([
                    Forms\Components\Select::make('type')
                        ->options([
                            'commercial' => 'Comercial',
                            'habitat' => 'Habitacional',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('code')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('NIS')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('file')
                        ->maxLength(255),
                ]),

                Forms\Components\Fieldset::make('group_location')->schema([
                    Forms\Components\Select::make('zone')
                        ->options(Zone::all()->pluck('name', 'id'))
                        ->native(false)
                        ->required(),

                    Forms\Components\Select::make('street')
                        ->options(Street::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('avenue')
                        ->options(Avenue::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('colony')
                        ->options(Colony::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\Select::make('passage')
                        ->options(Passage::all()->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\TextInput::make('block')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('number_house')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('reference')
                        ->columnSpanFull(),
                ]),

                Map::make('location')
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
                    ->type()
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

                Forms\Components\Fieldset::make('group_complementation')->schema([
                    Forms\Components\DatePicker::make('register')
                        ->native(false)
                        ->maxDate(now())
                        ->weekStartsOnMonday()
                        ->required(),
                    Forms\Components\TextInput::make('measure')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('zone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NIS')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('avenue')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('colony')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('passage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('block')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_house')
                    ->searchable(),
                Tables\Columns\TextColumn::make('register')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('measure')
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
