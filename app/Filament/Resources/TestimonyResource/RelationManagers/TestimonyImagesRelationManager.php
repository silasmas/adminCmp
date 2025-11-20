<?php
// TestimonyImagesRelationManager.php
namespace App\Filament\Resources\TestimonyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\RelationManagers\RelationManager;

class TestimonyImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Images';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('image')
                    ->label('Chemin image')
                    ->required()
                    ->maxLength(100),

                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Ajoutée le')
                    ->default(now())
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                   ImageColumn::make('url')
                ->label('Image')
                ->size(80)
                ->extraImgAttributes(['class' => 'object-cover'])
                ->url(fn ($record) => $record->url)
                ->openUrlInNewTab(),
                // Tables\Columns\TextColumn::make('image')
                //     ->label('Image')
                //     ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ajoutée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Ajouter une image'),
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
