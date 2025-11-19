<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberProfileResource\Pages;
use App\Filament\Resources\MemberProfileResource\RelationManagers\TestimoniesRelationManager;
use App\Models\MemberProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MemberProfileResource extends Resource
{
    protected static ?string $model = MemberProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Membres';

    protected static ?string $modelLabel = 'Membre';

    protected static ?string $pluralModelLabel = 'Profils membres';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique('wall_memberprofile', 'email', ignoreRecord: true)
                    ->maxLength(191),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(150),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(150),
                    ]),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Créé le')
                            ->default(now())
                            ->required(),

                        Forms\Components\DateTimePicker::make('updated_at')
                            ->label('Mis à jour le')
                            ->default(now())
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('testimonies_count')
                    ->label('Nb témoignages')
                    ->counts('testimonies')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Voir'),
                Tables\Actions\EditAction::make()
                    ->label('Modifier'),
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Supprimer la sélection'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TestimoniesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMemberProfiles::route('/'),
            'create' => Pages\CreateMemberProfile::route('/create'),
            'edit' => Pages\EditMemberProfile::route('/{record}/edit'),
            'view' => Pages\ViewMemberProfile::route('/{record}'),
        ];
    }
}
