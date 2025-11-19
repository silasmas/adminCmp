<?php
// TestimonyAmensRelationManager.php
namespace App\Filament\Resources\TestimonyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonyAmensRelationManager extends RelationManager
{
    protected static string $relationship = 'amens';

    protected static ?string $title = 'Amens';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('session_key')
                    ->label('Session key')
                    ->required()
                    ->maxLength(64),

                Forms\Components\TextInput::make('user_email')
                    ->label('Email utilisateur')
                    ->required()
                    ->maxLength(254),

                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Ajouté le')
                    ->default(now())
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_email')
                    ->label('Email utilisateur')
                    ->searchable(),

                Tables\Columns\TextColumn::make('session_key')
                    ->label('Session key')
                    ->limit(20),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Ajouter un Amen'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Supprimer la sélection'),
            ]);
    }
}
