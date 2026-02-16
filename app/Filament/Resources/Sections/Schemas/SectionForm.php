<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('page_id')
                    ->label('Página')
                    ->relationship('page', 'title')
                    ->required(),
                TextInput::make('type')
                    ->label('Tipo')
                    ->required(),
                TextInput::make('key')
                    ->label('Chave'),
                TextInput::make('title')
                    ->label('Título'),
                Textarea::make('subtitle')
                    ->label('Subtitulo')
                    ->columnSpanFull(),
                Textarea::make('payload')
                    ->label('Carga (JSON)')
                    ->formatStateUsing(fn ($state): string => json_encode($state ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                    ->dehydrateStateUsing(function ($state): array {
                        if (blank($state)) {
                            return [];
                        }

                        $decoded = json_decode((string) $state, true);

                        return is_array($decoded) ? $decoded : [];
                    })
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('Ordem')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Ativo')
                    ->required(),
            ]);
    }
}
