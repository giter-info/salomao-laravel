<?php

namespace App\Filament\Resources\MediaAssets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaAssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unit.name')
                    ->label('Unidade')
                    ->searchable(),
                TextColumn::make('collection')
                    ->label('Coleção')
                    ->searchable(),
                TextColumn::make('disk')
                    ->label('Disco')
                    ->searchable(),
                TextColumn::make('path')
                    ->label('Caminho')
                    ->searchable(),
                TextColumn::make('filename')
                    ->label('Arquivo')
                    ->searchable(),
                TextColumn::make('mime_type')
                    ->label('Tipo MIME')
                    ->searchable(),
                TextColumn::make('size')
                    ->label('Tamanho')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('width')
                    ->label('Largura')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('height')
                    ->label('Altura')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('alt_text')
                    ->label('Texto Alternativo')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Criado Em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado Em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
