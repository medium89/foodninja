<?php

namespace App\Filament\Resources\ShortLinkResource\Pages;

use App\Filament\Resources\ShortLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewShortLink extends ViewRecord
{
    protected static string $resource = ShortLinkResource::class;

    protected static ?string $title = 'Статистика ссылки';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
