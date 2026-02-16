<?php

namespace App\Filament\Resources\Units\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Código')
                    ->searchable(),
                TextColumn::make('hero_title')
                    ->label('Título Hero')
                    ->searchable(),
                TextColumn::make('contact_phone')
                    ->label('Telefone')
                    ->searchable(),
                TextColumn::make('contact_whatsapp')
                    ->label('WhatsApp')
                    ->searchable(),
                TextColumn::make('contact_email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('address_line')
                    ->label('Endereço')
                    ->searchable(),
                TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable(),
                TextColumn::make('state')
                    ->label('Estado')
                    ->searchable(),
                TextColumn::make('zip_code')
                    ->label('CEP')
                    ->searchable(),
                TextColumn::make('seo_title')
                    ->label('Título SEO')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('seo_canonical_url')
                    ->label('URL Canônica')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sort_order')
                    ->label('Ordem')
                    ->numeric()
                    ->sortable(),
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
