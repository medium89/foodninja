<?php

namespace App\Filament\Resources\ShortLinkResource\Pages;

use App\Filament\Resources\ShortLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShortLink extends EditRecord
{
    protected static string $resource = ShortLinkResource::class;

    protected static ?string $title = 'Редактировать короткую ссылку';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
