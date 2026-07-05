<?php

namespace App\Filament\Resources\ShortLinkResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ClicksRelationManager extends RelationManager
{
    protected static string $relationship = 'clicks';

    protected static ?string $title = 'Переходы';

    protected static ?string $modelLabel = 'переход';

    protected static ?string $pluralModelLabel = 'переходы';

    public function form(Form $form): Form
    {
        return $form;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ip_address')
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP-адрес')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата и время перехода')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
