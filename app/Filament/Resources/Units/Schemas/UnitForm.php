<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                TextInput::make('code')
                    ->label('Código'),
                Textarea::make('summary')
                    ->label('Resumo')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),
                TextInput::make('hero_title')
                    ->label('Título Hero'),
                Textarea::make('hero_subtitle')
                    ->label('Subtitulo Hero')
                    ->columnSpanFull(),
                TextInput::make('contact_phone')
                    ->label('Telefone')
                    ->tel(),
                TextInput::make('contact_whatsapp')
                    ->label('WhatsApp'),
                TextInput::make('contact_email')
                    ->label('Email')
                    ->email(),
                TextInput::make('address_line')
                    ->label('Endereço'),
                TextInput::make('city')
                    ->label('Cidade'),
                TextInput::make('state')
                    ->label('Estado'),
                TextInput::make('zip_code')
                    ->label('CEP'),

                Section::make('SEO')
                    ->columns(2)
                    ->schema([
                        TextInput::make('seo_title')
                            ->label('Título SEO')
                            ->maxLength(255),
                        TextInput::make('seo_canonical_url')
                            ->label('URL Canônica')
                            ->url(),
                        Textarea::make('seo_description')
                            ->label('Descrição SEO')
                            ->rows(3)
                            ->columnSpanFull(),
                        TagsInput::make('seo_keywords')
                            ->label('SEO Keywords')
                            ->placeholder('Digite e pressione Enter')
                            ->columnSpanFull(),
                        Select::make('seo_robots')
                            ->label('Indexação (Robots)')
                            ->options([
                                'index,follow' => 'index,follow',
                                'noindex,follow' => 'noindex,follow',
                                'index,nofollow' => 'index,nofollow',
                                'noindex,nofollow' => 'noindex,nofollow',
                            ]),
                        TextInput::make('seo_author')
                            ->label('Autor'),
                        Select::make('seo_locale')
                            ->label('Localidade')
                            ->options([
                                'pt_BR' => 'pt_BR',
                                'pt_PT' => 'pt_PT',
                                'en_US' => 'en_US',
                            ]),
                        Select::make('seo_og_type')
                            ->label('Tipo OG')
                            ->options([
                                'website' => 'website',
                                'article' => 'article',
                                'profile' => 'profile',
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make('Open Graph / X (Twitter)')
                    ->columns(2)
                    ->schema([
                        TextInput::make('seo_og_title')
                            ->label('Título OG'),
                        Textarea::make('seo_og_description')
                            ->label('Descrição OG')
                            ->rows(2),
                        FileUpload::make('seo_og_image_path')
                            ->label('Imagem OG')
                            ->disk('public')
                            ->directory('seo')
                            ->image(),
                        Select::make('seo_twitter_card')
                            ->label('Card do X/Twitter')
                            ->options([
                                'summary' => 'summary',
                                'summary_large_image' => 'summary_large_image',
                            ]),
                        TextInput::make('seo_twitter_site')
                            ->label('Perfil do Site no X/Twitter')
                            ->placeholder('@usuario'),
                        TextInput::make('seo_twitter_creator')
                            ->label('Criador no X/Twitter')
                            ->placeholder('@usuario'),
                        TextInput::make('seo_twitter_title')
                            ->label('Título no X/Twitter'),
                        Textarea::make('seo_twitter_description')
                            ->label('Descrição no X/Twitter')
                            ->rows(2),
                        FileUpload::make('seo_twitter_image_path')
                            ->label('Imagem no X/Twitter')
                            ->disk('public')
                            ->directory('seo')
                            ->image(),
                    ])
                    ->columnSpanFull(),

                Section::make('Favicons')
                    ->description('Arquivos de ícone usados no <head> da unidade.')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('favicon_ico_path')
                            ->label('favicon.ico')
                            ->disk('public')
                            ->directory('favicons')
                            ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon']),
                        FileUpload::make('favicon_16_path')
                            ->label('Favicon 16x16')
                            ->disk('public')
                            ->directory('favicons')
                            ->image(),
                        FileUpload::make('favicon_32_path')
                            ->label('Favicon 32x32')
                            ->disk('public')
                            ->directory('favicons')
                            ->image(),
                        FileUpload::make('apple_touch_icon_path')
                            ->label('Icone Apple Touch')
                            ->disk('public')
                            ->directory('favicons')
                            ->image(),
                    ])
                    ->columnSpanFull(),

                Section::make('Tema e Tipografia')
                    ->description('Personalize as cores e fontes da unidade. Valores salvos no banco de dados.')
                    ->columns(2)
                    ->schema([
                        ColorPicker::make('theme.primary_color')
                            ->label('Cor Primária'),
                        ColorPicker::make('theme.info_color')
                            ->label('Cor de Informação'),
                        ColorPicker::make('theme.surface_color')
                            ->label('Cor Base (fundo)'),
                        ColorPicker::make('theme.white_color')
                            ->label('Cor Clara'),
                        ColorPicker::make('theme.dark_color')
                            ->label('Cor Escura'),
                        ColorPicker::make('theme.nav_bg_color')
                            ->label('Cor Navbar'),
                        ColorPicker::make('theme.footer_bg_color')
                            ->label('Cor Footer'),
                        ColorPicker::make('theme.mobile_menu_bg_color')
                            ->label('Cor Menu Mobile'),
                        ColorPicker::make('theme.mobile_menu_text_color')
                            ->label('Texto Menu Mobile'),
                        ColorPicker::make('theme.hero_overlay_top')
                            ->label('Overlay Hero (topo)'),
                        ColorPicker::make('theme.hero_overlay_bottom')
                            ->label('Overlay Hero (base)'),
                        ColorPicker::make('theme.panel_from_color')
                            ->label('Bloco Gradiente (início)'),
                        ColorPicker::make('theme.panel_to_color')
                            ->label('Bloco Gradiente (fim)'),
                        ColorPicker::make('theme.card_bg_color')
                            ->label('Fundo dos Cards'),
                        Select::make('theme.font_body')
                            ->label('Fonte do Corpo')
                            ->options([
                                'Montserrat' => 'Montserrat',
                                'Nunito Sans' => 'Nunito Sans',
                                'Roboto Slab' => 'Roboto Slab',
                            ]),
                        Select::make('theme.font_heading')
                            ->label('Fonte dos Títulos')
                            ->options([
                                'Delius' => 'Delius',
                                'Nunito Sans' => 'Nunito Sans',
                                'Roboto Slab' => 'Roboto Slab',
                                'Montserrat' => 'Montserrat',
                            ]),
                    ])
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
