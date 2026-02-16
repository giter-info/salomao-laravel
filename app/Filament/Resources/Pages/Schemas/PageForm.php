<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('unit_id')
                    ->label('Unidade')
                    ->relationship('unit', 'name'),
                TextInput::make('title')
                    ->label('Título')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                TextInput::make('path')
                    ->label('Caminho')
                    ->required(),
                TextInput::make('menu_label')
                    ->label('Rótulo do Menu'),
                TextInput::make('template')
                    ->label('Template')
                    ->required()
                    ->default('default'),
                Textarea::make('excerpt')
                    ->label('Resumo')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Conteúdo')
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->label('Meta Título'),
                Textarea::make('meta_description')
                    ->label('Meta Descrição')
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->label('Meta Palavras-chave (JSON)')
                    ->formatStateUsing(fn ($state): string => json_encode($state ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                    ->dehydrateStateUsing(function ($state): array {
                        if (blank($state)) {
                            return [];
                        }

                        $decoded = json_decode((string) $state, true);

                        return is_array($decoded) ? $decoded : [];
                    })
                    ->columnSpanFull(),
                FileUpload::make('og_image_path')
                    ->label('Imagem OG')
                    ->image(),
                TextInput::make('canonical_url')
                    ->label('URL Canônica')
                    ->url(),
                Toggle::make('is_home')
                    ->label('Página Inicial')
                    ->required(),
                Toggle::make('is_published')
                    ->label('Publicado')
                    ->required(),
                DateTimePicker::make('published_at')
                    ->label('Data de Publicação'),
                TextInput::make('sort_order')
                    ->label('Ordem')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
