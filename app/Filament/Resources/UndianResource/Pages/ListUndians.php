<?php

namespace App\Filament\Resources\UndianResource\Pages;

use App\Filament\Resources\UndianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUndians extends ListRecords
{
    protected static string $resource = UndianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
