<?php

namespace App\Filament\Resources\ShortLinkResource\Pages;

use App\Filament\Resources\ShortLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShortLinks extends ListRecords
{
    protected static string $resource = ShortLinkResource::class;

    protected static ?string $title = 'Короткие ссылки';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
