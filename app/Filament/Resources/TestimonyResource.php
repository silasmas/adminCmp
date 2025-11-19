<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonyResource\Pages;
use App\Filament\Resources\TestimonyResource\RelationManagers\TestimonyImagesRelationManager;
use App\Filament\Resources\TestimonyResource\RelationManagers\TestimonyAmensRelationManager;
use App\Models\Testimony;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestimonyResource extends Resource
{
    protected static ?string $model = Testimony::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Témoignages';

    protected static ?string $pluralModelLabel = 'Témoignages';

    protected static ?string $modelLabel = 'Témoignage';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations de base')
                    ->description('Identité du membre et informations principales du témoignage.')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->label('Prénom')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('last_name')
                                    ->label('Nom')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('category')
                                    ->label('Catégorie')
                                    ->placeholder('Guérison, Finances, Famille...')
                                    ->maxLength(100),
                            ]),

                        Forms\Components\TextInput::make('title')
                            ->label('Titre du témoignage')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(254),

                                Forms\Components\TextInput::make('phone')
                                    ->label('Téléphone')
                                    ->required()
                                    ->maxLength(30),
                            ]),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Contenu du témoignage')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('kind')
                                    ->label('Type')
                                    ->required()
                                    ->options([
                                        'text' => 'Texte',
                                        'video' => 'Vidéo (lien)',
                                        'mix' => 'Mix texte + vidéo',
                                    ])
                                    ->native(false),

                                Forms\Components\TextInput::make('postit_color')
                                    ->label('Couleur post-it')
                                    ->helperText('Ex: yellow, #FFEB3B, bg-yellow-200...')
                                    ->required()
                                    ->maxLength(20),

                                Forms\Components\TextInput::make('font_family')
                                    ->label('Police (CSS)')
                                    ->helperText('Ex: Poppins, "Open Sans", cursive...')
                                    ->required()
                                    ->maxLength(100),
                            ]),

                        Forms\Components\Textarea::make('text')
                            ->label('Texte du témoignage')
                            ->rows(6)
                            ->columnSpanFull()
                            ->hint('Obligatoire pour les types "text" et "mix".'),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('video')
                                    ->label('Lien vidéo (YouTube, Vimeo, etc.)')
                                    ->url()
                                    ->maxLength(200),

                                Forms\Components\TextInput::make('video_file')
                                    ->label('Nom du fichier vidéo (si stocké ailleurs)')
                                    ->maxLength(100),
                            ]),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Vérification & statut')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('verification_type')
                                    ->label('Type de vérification')
                                    ->required()
                                    ->options([
                                        'email' => 'Email',
                                        'phone' => 'Téléphone',
                                        'both' => 'Email + Téléphone',
                                    ])
                                    ->native(false),

                                Forms\Components\Select::make('status')
                                    ->label('Statut')
                                    ->required()
                                    ->options([
                                        'pending' => 'En attente',
                                        'approved' => 'Approuvé',
                                        'rejected' => 'Rejeté',
                                        'hidden' => 'Caché',
                                    ])
                                    ->default('pending')
                                    ->native(false),

                                Forms\Components\DateTimePicker::make('created_at')
                                    ->label('Date de création')
                                    ->default(now())
                                    ->required(),
                            ]),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->toggleable()
                    ->size('sm'),

                Tables\Columns\TextColumn::make('kind')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'text' => 'Texte',
                        'video' => 'Vidéo',
                        'mix' => 'Mix',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'text',
                        'warning' => 'video',
                        'info' => 'mix',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->toggleable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'pending' => 'En attente',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                        'hidden' => 'Caché',
                        default => $state,
                    })
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                        'gray'    => 'hidden',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('verification_type')
                    ->label('Vérification')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                        'hidden' => 'Caché',
                    ]),

                Tables\Filters\SelectFilter::make('kind')
                    ->label('Type')
                    ->options([
                        'text' => 'Texte',
                        'video' => 'Vidéo',
                        'mix' => 'Mix',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->label('Date de création')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Du'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Au'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Voir'),
                Tables\Actions\EditAction::make()
                    ->label('Modifier'),
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Supprimer la sélection'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TestimonyImagesRelationManager::class,
            TestimonyAmensRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonies::route('/'),
            'create' => Pages\CreateTestimony::route('/create'),
            'edit' => Pages\EditTestimony::route('/{record}/edit'),
            'view' => Pages\ViewTestimony::route('/{record}'),
        ];
    }
}
