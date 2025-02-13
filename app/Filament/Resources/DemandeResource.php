<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Demande;
use App\Models\InfoTag;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use App\Filament\Resources\DemandeResource\Pages;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DemandeResource\RelationManagers;
use App\Filament\Resources\DemandeResource\Pages\EditDemande;
use App\Filament\Resources\DemandeResource\Pages\ListDemandes;
use App\Filament\Resources\DemandeResource\Pages\CreateDemande;

class DemandeResource extends Resource
{
    protected static ?string $model = Demande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Demandeur')
                        ->description('Veuillez fournir les informations sur le demandeur')
                        ->schema([
                            Grid::make(3) // Deux colonnes
                                ->schema([
                                    TextInput::make('prenom')
                                        ->label('Prénom')
                                        ->required()
                                        ->live()
                                        ->columnSpan(1),
                                    TextInput::make('nom')
                                        ->label('nom')
                                        ->required()
                                        ->columnSpan(1),
                                    Select::make('departement_id')
                                        ->label(label: 'Département')
                                        ->relationship('departement', 'nom')
                                        ->searchable()
                                        ->preload()
                                        ->columnSpan(1)
                                        ->required(),

                                ]),
                            Grid::make(2) // Deux colonnes
                                ->schema([
                                    TextInput::make('fonction')
                                        ->label('Fonction au département')
                                        ->required()
                                        ->columnSpan(1),
                                    TextInput::make('phone')
                                        ->label('Télephone')
                                        ->required()
                                        ->columnSpan(1),
                                    TextInput::make('whatsapp')
                                        ->label('Numéro WhatsApp')
                                        ->required()
                                        ->columnSpan(1),
                                    TextInput::make('email')
                                        ->label('E-mail (Pour reception du produit fini)')
                                        ->email()
                                        ->columnSpan(1)
                                        ->required(),
                                ]),
                        ]),

                    Step::make('Evenement')
                        ->schema([
                            Grid::make(2) // Deux colonnes
                                ->schema([
                                    TextInput::make('type')
                                        ->label('Type de la demande')
                                        ->required()
                                        ->columnSpan(1),
                                    TextInput::make('theme')
                                        ->label('Thème :')
                                        ->columnSpan(1),
                                    DateTimePicker::make('dateDebut')
                                        ->label('Date et heure de début')
                                        ->columnSpan(1),
                                    DateTimePicker::make('dateFin')
                                        ->label('Date et heure de fin')
                                        ->columnSpan(1),
                                    TagsInput::make('orateurs')
                                        ->label('Les orateurs')
                                        ->placeholder('vous pouvez ajouté pluslieurs nom...')
                                        ->required()
                                        ->separator(',')
                                        ->suggestions(InfoTag::pluck('nom')->toArray())
                                        ->saveRelationshipsWhenHidden() // Sauvegarde même si le champ est caché
                                        ->columnSpan(1),
                                    TagsInput::make('invites')
                                        ->label('Les invités')
                                        ->placeholder('vous pouvez ajouté pluslieurs nom...')
                                        ->required()
                                        ->separator(',')
                                        ->suggestions(InfoTag::pluck('nom')->toArray())
                                        ->saveRelationshipsWhenHidden() // Sauvegarde même si le champ est caché
                                        ->columnSpan(1),
                                    TextInput::make('lieu')
                                        ->label('Lieu')
                                        ->columnSpan(2),
                                    RichEditor::make('autresInfos')
                                        ->label(label: 'Autres parametres lié de la demande')
                                        ->toolbarButtons([
                                            'attachFiles',
                                            'blockquote',
                                            'bold',
                                            'bulletList',
                                            'codeBlock',
                                            'h2',
                                            'h3',
                                            'italic',
                                            'link',
                                            'orderedList',
                                            'redo',
                                            'strike',
                                            'underline',
                                            'undo',
                                        ])->columnSpan(2),
                                ]),
                        ]),

                    Step::make('Aspect technique et communicationnels')
                        ->schema([
                            Grid::make(2) // Deux colonnes
                                ->schema([
                                    TagsInput::make('formatImpression')
                                        ->label('Formats d\'impression')
                                        ->placeholder('Ajoutez un format A3, A0...')
                                        ->separator(',')
                                        ->suggestions(['A3 (Affiche)', 'A0 (Grand format)', 'A6 (Flyer)', 'Roll-up', 'Panneaux']) // Suggestions mais pas obligatoires
                                        ->required()
                                        ->columnSpanFull(),

                                    Radio::make('impression')
                                        ->label('Désirez-vou que CREA se charge des impressions ?')
                                        ->columnSpan(1)
                                        ->boolean()
                                        ->inline()
                                        ->inlineLabel(false),
                                    Radio::make('communication')
                                        ->label("Avez-vous besoin d'une diffusion en direct sur facebook ?")
                                        ->boolean()
                                        ->columnSpan(1)
                                        ->inline()
                                        ->inlineLabel(false)

                                ]),
                        ]),
                    Step::make('Description de la demande')
                        ->schema([
                            RichEditor::make('description')
                                ->placeholder("Véuillez nous fournir une description claire et concise de
                            l'événement (public cible, objectif poursuivi en organisant cet événement, les resultats
                            attendu). Avez-vous déjà organiser un événment au sein de votre département? Quels ont été
                             les résultats obtenus ...")
                                ->label(label: 'Description du département')
                                ->toolbarButtons([
                                    'attachFiles',
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                                ])->required()
                                ->columnSpanFull(),
                        ])->columnS(12),
                ])->persistStepInQueryString('wizard-step')
                    ->skippable(true) // Permet de sauter des étapes
                    ->columnSpanFull(), // Prend toute la largeur disponible
            ]);
    }

    public static function table(Table $table): Table
    {
        Table::$defaultNumberLocale = 'fr';
        return $table
            ->columns([
                ColumnGroup::make('Demandeur', [
                    TextColumn::make('prenom')
                        ->searchable()
                        ->searchable(isIndividual: true, isGlobal: false),
                    TextColumn::make('nom')
                        ->searchable(),
                ]),
                TextColumn::make('fonction')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('whatsapp')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('theme')
                    ->searchable(),
                TextColumn::make('dateDebut')->dateTime()
                ->icon('heroicon-o-clock')
->color('danger')
                    ->searchable(),
                TextColumn::make('dateFin')
                ->icon('heroicon-o-clock')
->color('success')
                    ->searchable()
                    ->searchable(),
                TextColumn::make('orateurs')
                    ->label('Orateurs')
                    ->width('1%')
                    ->wrap()
                    ->listWithLineBreaks()
                    ->badge()
                    ->separator(','),
                TextColumn::make('invites')
                    ->label('Invités')
                    ->width('1%')
                    ->wrap()
                    ->listWithLineBreaks()
                    ->badge()
                    ->separator(','),
                TextColumn::make('formatImpression')
                    ->label('Formats sélectionnés')
                    ->width('1%')
                    ->wrap()
                    ->listWithLineBreaks()
                    ->badge()
                    ->separator(',')
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    // Tables\Actions\RestoreAction::make(),
                    // Tables\Actions\DeleteAction::make(),
                    // Tables\Actions\ForceDeleteAction::make(),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListDemandes::route('/'),
            'create' => Pages\CreateDemande::route('/create'),
            'edit' => Pages\EditDemande::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where("etat", "en attente")->count();
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? "danger" : "success";
    }
}
