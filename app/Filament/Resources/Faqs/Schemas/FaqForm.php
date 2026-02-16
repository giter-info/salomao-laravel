<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
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
                TextInput::make('category')
                    ->label('Categoria'),
                TextInput::make('question')
                    ->label('Pergunta')
                    ->required(),
                Textarea::make('answer')
                    ->label('Resposta')
                    ->required()
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
