<?php

namespace App\Filament\Resources\TestimonyResource\Pages;

use Filament\Actions;
use App\Models\Testimony;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\TestimonyResource;

class EditTestimony extends EditRecord
{
    protected static string $resource = TestimonyResource::class;


     protected function getSavedNotificationTitle(): ?string
    {
        return 'Témoignage mis à jour';
    }
      protected function getHeaderActions(): array
    {
        return [
            
            
        
            // Bouton "Précédent"
            Actions\Action::make('previous')
                ->label('Précédent')
                ->icon('heroicon-o-arrow-left')
                ->color('primary')
                ->disabled(fn () => ! $this->getAdjacentRecordId('previous'))
                ->action(function () {
                    if ($url = $this->getAdjacentRecordUrl('previous')) {
                        $this->redirect($url);
                    }
                }),

            // Bouton "Suivant"
            Actions\Action::make('next')
                ->label('Suivant')
                ->icon('heroicon-o-arrow-right')
                ->color('primary')
                ->disabled(fn () => ! $this->getAdjacentRecordId('next'))
                ->action(function () {
                    if ($url = $this->getAdjacentRecordUrl('next')) {
                        $this->redirect($url);
                    }
                }),

            // Action native de suppression
            Actions\DeleteAction::make()
                ->label('Supprimer'),
        ];
    }

    /**
     * Retourne l'ID du témoignage précédent / suivant.
     * Ici on se base sur l'ID, mais tu peux utiliser created_at si tu veux.
     */
    // protected function getAdjacentRecordId(string $direction): ?int
    // {
    //     $currentId = $this->record->id;

    //     if ($direction === 'previous') {
    //         return Testimony::where('id', '<', $currentId)
    //             ->max('id'); // l'id juste en dessous
    //     }

    //     if ($direction === 'next') {
    //         return Testimony::where('id', '>', $currentId)
    //             ->min('id'); // l'id juste au-dessus
    //     }

    //     return null;
    // }

    /**
     * Construit l’URL Filament de l’enregistrement adjacent.
     */
    protected function getAdjacentRecordUrl(string $direction): ?string
    {
        if (! $adjacentId = $this->getAdjacentRecordId($direction)) {
            return null;
        }

        return static::getResource()::getUrl('edit', ['record' => $adjacentId]);
    }
    protected function getAdjacentRecordId(string $direction): ?int
{
    $current = $this->record;

    if ($direction === 'previous') {
        return Testimony::where('created_at', '<', $current->created_at)
            ->orderBy('created_at', 'desc')
            ->value('id');
    }

    if ($direction === 'next') {
        return Testimony::where('created_at', '>', $current->created_at)
            ->orderBy('created_at', 'asc')
            ->value('id');
    }

    return null;
}
}
