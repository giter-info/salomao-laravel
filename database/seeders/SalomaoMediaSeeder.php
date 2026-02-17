<?php

namespace Database\Seeders;

use App\Models\MediaAsset;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SalomaoMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceBase = (string) config('app.salomao_site_path', '/var/salomao-site');

        if (! File::isDirectory($sourceBase)) {
            $this->command?->warn("Fonte de mídia não encontrada em: {$sourceBase}");
            return;
        }

        $targets = [
            [
                'source' => $sourceBase.'/public',
                'prefix' => 'imported/salomao-site/public',
            ],
            [
                'source' => $sourceBase.'/app/images',
                'prefix' => 'imported/salomao-site/images',
            ],
        ];

        $disk = Storage::disk('public');

        foreach ($targets as $target) {
            if (! File::isDirectory($target['source'])) {
                continue;
            }

            $files = File::allFiles($target['source']);

            foreach ($files as $file) {
                $sourcePath = $file->getPathname();
                $relativePath = str_replace('\\', '/', $file->getRelativePathname());
                $destinationPath = $target['prefix'].'/'.$relativePath;
                $destinationDir = dirname($destinationPath);

                if (! $disk->exists($destinationDir)) {
                    $disk->makeDirectory($destinationDir);
                }

                $disk->put($destinationPath, File::get($sourcePath));

                $normalized = Str::lower($destinationPath);

                $unit = $this->inferUnit($normalized);
                $collection = $this->inferCollection($normalized);
                $mimeType = File::mimeType($sourcePath);
                $size = File::size($sourcePath);

                [$width, $height] = $this->getImageDimensions($sourcePath);

                MediaAsset::updateOrCreate(
                    [
                        'disk' => 'public',
                        'path' => $destinationPath,
                    ],
                    [
                        'unit_id' => $unit?->id,
                        'collection' => $collection,
                        'filename' => basename($destinationPath),
                        'mime_type' => $mimeType,
                        'size' => $size ?: null,
                        'width' => $width,
                        'height' => $height,
                        'alt_text' => null,
                        'title' => $this->humanizeFilename($file->getFilename()),
                        'meta' => [
                            'source' => $sourcePath,
                        ],
                        'is_active' => true,
                    ]
                );
            }
        }
    }

    private function inferUnit(string $path): ?Unit
    {
        if (Str::contains($path, ['/images/rt/', 'logo-rt', 'bg-rt'])) {
            return Unit::query()->where('slug', 'residencial-terapeutico')->first();
        }

        if (Str::contains($path, ['/images/ri/', 'logo-ri', 'bg-ri'])) {
            return Unit::query()->where('slug', 'residencia-inclusiva')->first();
        }

        if (Str::contains($path, ['/images/as/', 'logo-dog', 'bg-as'])) {
            return Unit::query()->where('slug', 'adestramento-salomao')->first();
        }

        return null;
    }

    private function inferCollection(string $path): string
    {
        if (Str::contains($path, '/estrutura/')) {
            return 'estrutura';
        }

        if (Str::contains($path, ['portif', 'portfolio'])) {
            return 'portfolio';
        }

        if (Str::contains($path, '/layout/')) {
            return 'branding';
        }

        if (Str::contains($path, '/home/')) {
            return 'home';
        }

        if (Str::contains($path, '/public/')) {
            return 'public';
        }

        return 'default';
    }

    /**
     * @return array{0: int|null, 1: int|null}
     */
    private function getImageDimensions(string $sourcePath): array
    {
        $imageInfo = @getimagesize($sourcePath);

        if ($imageInfo === false) {
            return [null, null];
        }

        return [
            isset($imageInfo[0]) ? (int) $imageInfo[0] : null,
            isset($imageInfo[1]) ? (int) $imageInfo[1] : null,
        ];
    }

    private function humanizeFilename(string $filename): string
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $name = str_replace(['_', '-'], ' ', $name);

        return Str::title(trim($name));
    }
}
