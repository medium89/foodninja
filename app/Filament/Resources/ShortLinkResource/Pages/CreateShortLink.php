<?php

namespace App\Filament\Resources\ShortLinkResource\Pages;

use App\Filament\Resources\ShortLinkResource;
use App\Models\ShortLink;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateShortLink extends CreateRecord
{
    protected static string $resource = ShortLinkResource::class;

    protected static ?string $title = 'Создать короткую ссылку';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['code'] = $this->generateUniqueCode();

        return $data;
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = Str::random(6);
        } while (ShortLink::where('code', $code)->exists());

        return $code;
    }
}
