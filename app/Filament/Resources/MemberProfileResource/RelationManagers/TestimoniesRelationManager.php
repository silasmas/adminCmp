<?php
// TestimoniesRelationManager.php
namespace App\Filament\Resources\MemberProfileResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TestimoniesRelationManager extends RelationManager
{
    protected static string $relationship = 'testimonies';

    protected static ?string $title = 'Témoignages';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Optionnel : tu peux reprendre une version simplifiée du formulaire Testimony
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                        'hidden' => 'Caché',
                    ])
                    ->default('pending')
                    ->native(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->limit(40)
                    ->searchable(),

                Tables\Columns\TextColumn::make('kind')
                    ->label('Type')
                    ->badge(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'En attente',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                        'hidden' => 'Caché',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Ajouter un témoignage'),
            ])
            ->actions([
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
}
