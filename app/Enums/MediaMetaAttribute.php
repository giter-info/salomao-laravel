<?php

namespace App\Enums;

enum MediaMetaAttribute: string
{
    case SOURCE = 'source';
    case ORIGEM = 'origem';
    case CAMPANHA = 'campanha';
    case FOTOGRAFO = 'fotografo';
    case FOCO = 'foco';
    case LICENCA = 'licenca';
    case CREDITOS = 'creditos';
    case CAPTION = 'caption';
    case TAGS = 'tags';
    case CROP = 'crop';

    public function label(): string
    {
        return match ($this) {
            self::SOURCE => 'Source',
            self::ORIGEM => 'Origem',
            self::CAMPANHA => 'Campanha',
            self::FOTOGRAFO => 'Fotografo',
            self::FOCO => 'Foco',
            self::LICENCA => 'Licenca',
            self::CREDITOS => 'Creditos',
            self::CAPTION => 'Caption',
            self::TAGS => 'Tags',
            self::CROP => 'Crop',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
