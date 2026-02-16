<?php

namespace App\Filament\Resources\Pages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unit.name')
                    ->label('Unidade')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('path')
                    ->label('Caminho')
                    ->searchable(),
                TextColumn::make('menu_label')
                    ->label('Menu')
                    ->searchable(),
                TextColumn::make('template')
                    ->label('Template')
                    ->searchable(),
                TextColumn::make('meta_title')
                    ->label('Meta Título')
                    ->searchable(),
                ImageColumn::make('og_image_path')
                    ->label('Imagem OG'),
                TextColumn::make('canonical_url')
                    ->label('URL Canônica')
                    ->searchable(),
                IconColumn::make('is_home')
                    ->label('Inicial')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
                TextColumn::make('published_at')
                    ->label('Publicado Em')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label('Ordem')
                    ->numeric()
                    ->sortable(),
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
                TextColumn::make('deleted_at')
                    ->label('Excluído Em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
