<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('unit_id')
                    ->label('Unidade')
                    ->relationship('unit', 'name'),
                Select::make('page_id')
                    ->label('Página')
                    ->relationship('page', 'title'),
                TextInput::make('title')
                    ->label('Título')
                    ->required(),
                Textarea::make('summary')
                    ->label('Resumo')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),
                TextInput::make('external_url')
                    ->label('URL Externa')
                    ->url(),
                TextInput::make('file_path')
                    ->label('Caminho do Arquivo'),
                TextInput::make('thumbnail_path')
                    ->label('Caminho da Miniatura'),
                DateTimePicker::make('published_at')
                    ->label('Publicado Em'),
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
