<?php

namespace App\Filament\Resources\Diseases\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DiseaseForm
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
                TextInput::make('code')
                    ->label('Código'),
                Textarea::make('summary')
                    ->label('Resumo')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Descrição')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('details')
                    ->label('Detalhes')
                    ->table([
                        TableColumn::make('Detalhe')
                            ->markAsRequired(),
                    ])
                    ->schema([
                        Textarea::make('text')
                            ->hiddenLabel()
                            ->rows(2)
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->addActionLabel('Adicionar detalhe')
                    ->defaultItems(0)
                    ->reorderable()
                    ->compact()
                    ->collapsible()
                    ->formatStateUsing(function ($state): array {
                        if (! is_array($state)) {
                            return [];
                        }

                        return collect($state)
                            ->map(function ($item): array {
                                if (is_string($item)) {
                                    return ['text' => $item];
                                }

                                if (is_array($item)) {
                                    $value = $item['text'] ?? $item['value'] ?? $item['detail'] ?? reset($item) ?? '';

                                    return ['text' => (string) $value];
                                }

                                return ['text' => (string) $item];
                            })
                            ->filter(fn (array $item): bool => trim($item['text']) !== '')
                            ->values()
                            ->all();
                    })
                    ->dehydrateStateUsing(function ($state): array {
                        if (! is_array($state)) {
                            return [];
                        }

                        return collect($state)
                            ->map(fn (array $item): string => trim((string) ($item['text'] ?? '')))
                            ->filter(fn (string $item): bool => $item !== '')
                            ->values()
                            ->all();
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
