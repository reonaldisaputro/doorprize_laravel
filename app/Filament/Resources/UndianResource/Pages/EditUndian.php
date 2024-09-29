<?php

namespace App\Filament\Resources\UndianResource\Pages;

use App\Filament\Resources\UndianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUndian extends EditRecord
{
    protected static string $resource = UndianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
