<?php

namespace App\Filament\Resources\VerificationCodeResource\Pages;

use App\Filament\Resources\VerificationCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVerificationCode extends CreateRecord
{
    protected static string $resource = VerificationCodeResource::class;
}
