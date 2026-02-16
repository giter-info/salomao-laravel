<?php

namespace App\Filament\Resources\MediaAssets\Schemas;

use App\Enums\MediaMetaAttribute;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MediaAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('unit_id')
                    ->label('Unidade')
                    ->relationship('unit', 'name'),
                TextInput::make('collection')
                    ->label('Colecao')
                    ->required()
                    ->default('default'),
                TextInput::make('disk')
                    ->label('Disco')
                    ->required()
                    ->default('public'),
                TextInput::make('path')
                    ->label('Caminho')
                    ->required(),
                TextInput::make('filename')
                    ->label('Nome do Arquivo')
                    ->required(),
                TextInput::make('mime_type')
                    ->label('Tipo MIME'),
                TextInput::make('size')
                    ->label('Tamanho')
                    ->numeric(),
                TextInput::make('width')
                    ->label('Largura')
                    ->numeric(),
                TextInput::make('height')
                    ->label('Altura')
                    ->numeric(),
                TextInput::make('alt_text')
                    ->label('Texto Alternativo'),
                TextInput::make('title')
                    ->label('Titulo'),
                Repeater::make('meta')
                    ->label('Metadados')
                    ->table([
                        TableColumn::make('Atributo')->markAsRequired(),
                        TableColumn::make('Informacao')->markAsRequired(),
                    ])
                    ->schema([
                        Select::make('key')
                            ->label('Atributo')
                            ->options(MediaMetaAttribute::options())
                            ->searchable()
                            ->required()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                        TextInput::make('value')
                            ->label('Informacao')
                            ->required(),
                    ])
                    ->addActionLabel('Adicionar metadado')
                    ->defaultItems(0)
                    ->reorderable()
                    ->compact()
                    ->formatStateUsing(function ($state): array {
                        if (! is_array($state)) {
                            return [];
                        }

                        if (array_is_list($state)) {
                            return collect($state)
                                ->map(function ($item): array {
                                    if (! is_array($item)) {
                                        return ['key' => 'source', 'value' => (string) $item];
                                    }

                                    $key = $item['key'] ?? null;
                                    $value = $item['value'] ?? null;

                                    if ($key === null && count($item) === 1) {
                                        $key = (string) array_key_first($item);
                                        $value = (string) reset($item);
                                    }

                                    return [
                                        'key' => is_string($key) ? $key : 'source',
                                        'value' => is_scalar($value) ? (string) $value : '',
                                    ];
                                })
                                ->filter(fn (array $item): bool => trim($item['value']) !== '')
                                ->values()
                                ->all();
                        }

                        return collect($state)
                            ->map(fn ($value, $key): array => [
                                'key' => (string) $key,
                                'value' => is_scalar($value) ? (string) $value : '',
                            ])
                            ->filter(fn (array $item): bool => trim($item['value']) !== '')
                            ->values()
                            ->all();
                    })
                    ->dehydrateStateUsing(function ($state): array {
                        if (! is_array($state)) {
                            return [];
                        }

                        $meta = [];

                        foreach ($state as $row) {
                            if (! is_array($row)) {
                                continue;
                            }

                            $key = trim((string) ($row['key'] ?? ''));
                            $value = trim((string) ($row['value'] ?? ''));

                            if ($key === '' || $value === '') {
                                continue;
                            }

                            $meta[$key] = $value;
                        }

                        return $meta;
                    })
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Ativo')
                    ->required(),
            ]);
    }
}
