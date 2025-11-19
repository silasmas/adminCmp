<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerificationCodeResource\Pages;
use App\Models\VerificationCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VerificationCodeResource extends Resource
{
    protected static ?string $model = VerificationCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'Codes de vérification';

    protected static ?string $modelLabel = 'Code de vérification';

    protected static ?string $pluralModelLabel = 'Codes de vérification';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(191),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(100),
                    ]),

                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required()
                    ->maxLength(64),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Créé le')
                            ->default(now())
                            ->required(),

                        Forms\Components\DateTimePicker::make('expires_at')
                            ->label('Expire le')
                            ->required(),
                    ]),

                Forms\Components\Toggle::make('used')
                    ->label('Utilisé')
                    ->inline(false)
                    ->default(false),

                Forms\Components\TextInput::make('attempts')
                    ->label('Tentatives')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom'),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom'),

                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->copyable()
                    ->limit(16),

                Tables\Columns\IconColumn::make('used')
                    ->label('Utilisé')
                    ->boolean(),

                Tables\Columns\TextColumn::make('attempts')
                    ->label('Tentatives')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('expires_at')
                    ->label('Expire le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('used')
                    ->label('Utilisation'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerificationCodes::route('/'),
            'create' => Pages\CreateVerificationCode::route('/create'),
            'edit' => Pages\EditVerificationCode::route('/{record}/edit'),
        ];
    }
}
