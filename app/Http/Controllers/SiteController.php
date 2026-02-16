<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use App\Models\Page;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SiteController extends Controller
{
    public function show(Request $request, ?string $path = null)
    {
        if (! Schema::hasTable('pages')) {
            return view('welcome');
        }

        $resolvedPath = $this->normalizePath($path);

        $page = Page::query()
            ->with([
                'unit',
                'sections' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order'),
                'faqs' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order'),
                'diseases' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order'),
                'materials' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order'),
            ])
            ->where('path', $resolvedPath)
            ->where('is_published', true)
            ->firstOrFail();

        $rootMenu = Page::query()
            ->whereNull('unit_id')
            ->where('is_published', true)
            ->whereNotNull('menu_label')
            ->orderBy('sort_order')
            ->get(['menu_label', 'path']);

        $unitMenu = collect();

        if ($page->unit_id !== null) {
            $unitMenu = Page::query()
                ->where('unit_id', $page->unit_id)
                ->where('is_published', true)
                ->whereNotNull('menu_label')
                ->orderBy('sort_order')
                ->get(['menu_label', 'path']);
        }

        $units = Unit::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $structureMedia = collect();
        $portfolioMedia = collect();
        $template = (string) $page->template;

        if ($page->unit_id !== null && str_contains($template, 'structure')) {
            $structureMedia = MediaAsset::query()
                ->where('unit_id', $page->unit_id)
                ->where('collection', 'estrutura')
                ->where('is_active', true)
                ->orderBy('path')
                ->get();
        }

        if ($resolvedPath === '/saibamais') {
            $portfolioMedia = MediaAsset::query()
                ->where('collection', 'portfolio')
                ->where('is_active', true)
                ->orderBy('path')
                ->get();
        }

        $themeName = $this->themeNameForPage($page);
        $themePalette = $this->resolveThemePalette($page);
        $seo = $this->resolveSeoData($page);

        return view('site.page', [
            'page' => $page,
            'unit' => $page->unit,
            'rootMenu' => $rootMenu,
            'unitMenu' => $unitMenu,
            'units' => $units,
            'structureMedia' => $structureMedia,
            'portfolioMedia' => $portfolioMedia,
            'heroBackground' => $this->heroBackgroundForPath($resolvedPath),
            'brandLogo' => '/storage/imported/salomao-site/images/layout/brand.png',
            'unitLogo' => $this->unitLogoForPage($page),
            'theme' => $themeName,
            'themeCssVars' => $this->buildThemeCssVars($themePalette),
            'whatsappUrl' => $this->whatsappUrlForPage($page),
            'seo' => $seo,
        ]);
    }

    private function normalizePath(?string $path): string
    {
        if ($path === null || $path === '') {
            return '/';
        }

        return '/'.trim($path, '/');
    }

    private function heroBackgroundForPath(string $path): string
    {
        if ($path === '/' || str_starts_with($path, '/sobre')) {
            return '/storage/imported/salomao-site/public/bg-root.png';
        }

        if (str_starts_with($path, '/unidades')) {
            return '/storage/imported/salomao-site/public/bg-units.png';
        }

        if (str_starts_with($path, '/residencial-terapeutico') || str_starts_with($path, '/saibamais')) {
            return '/storage/imported/salomao-site/public/bg-rt.png';
        }

        if (str_starts_with($path, '/residencia-inclusiva')) {
            return '/storage/imported/salomao-site/public/bg-ri.png';
        }

        if (str_starts_with($path, '/adestramento-salomao')) {
            return '/storage/imported/salomao-site/public/bg-as.png';
        }

        return '/storage/imported/salomao-site/public/bg-2.png';
    }

    private function unitLogoForPage(Page $page): string
    {
        if ($page->unit?->slug === 'residencial-terapeutico') {
            return '/storage/imported/salomao-site/images/layout/logo-rt.png';
        }

        if ($page->unit?->slug === 'residencia-inclusiva') {
            return '/storage/imported/salomao-site/images/layout/logo-ri.png';
        }

        if ($page->unit?->slug === 'adestramento-salomao') {
            return '/storage/imported/salomao-site/images/layout/logo-dog.png';
        }

        return '/storage/imported/salomao-site/images/layout/brand.png';
    }

    private function themeNameForPage(Page $page): string
    {
        return match ($page->unit?->slug) {
            'residencia-inclusiva' => 'ri',
            'adestramento-salomao' => 'as',
            default => 'rt',
        };
    }

    /**
     * @return array<string, string>
     */
    private function resolveThemePalette(Page $page): array
    {
        $defaults = match ($this->themeNameForPage($page)) {
            'ri' => [
                'primary_color' => '#3efec9',
                'info_color' => '#71c8a0',
                'surface_color' => '#004148',
                'white_color' => '#f2f0eb',
                'dark_color' => '#0d0d0d',
                'nav_bg_color' => '#004148',
                'footer_bg_color' => '#004148',
                'hero_overlay_top' => '#0041489e',
                'hero_overlay_bottom' => '#033427bf',
                'mobile_menu_bg_color' => '#2cb3b1',
                'mobile_menu_text_color' => '#0d0d0d',
                'panel_from_color' => '#2592897a',
                'panel_to_color' => '#0334279e',
                'card_bg_color' => '#0041486e',
                'font_body' => 'Nunito Sans',
                'font_heading' => 'Nunito Sans',
            ],
            'as' => [
                'primary_color' => '#85f2ca',
                'info_color' => '#bdf2d9',
                'surface_color' => '#252525',
                'white_color' => '#f2f0eb',
                'dark_color' => '#0d0d0d',
                'nav_bg_color' => '#252525',
                'footer_bg_color' => '#252525',
                'hero_overlay_top' => '#25252599',
                'hero_overlay_bottom' => '#252525c2',
                'mobile_menu_bg_color' => '#2cb3b1',
                'mobile_menu_text_color' => '#0d0d0d',
                'panel_from_color' => '#25252575',
                'panel_to_color' => '#121212ad',
                'card_bg_color' => '#1f1f1f99',
                'font_body' => 'Montserrat',
                'font_heading' => 'Delius',
            ],
            default => [
                'primary_color' => '#85f2ca',
                'info_color' => '#bdf2d9',
                'surface_color' => '#1b402b',
                'white_color' => '#f2f0eb',
                'dark_color' => '#0d0d0d',
                'nav_bg_color' => '#1b402b',
                'footer_bg_color' => '#07150f',
                'hero_overlay_top' => '#10241ab3',
                'hero_overlay_bottom' => '#10241ad1',
                'mobile_menu_bg_color' => '#1b402b',
                'mobile_menu_text_color' => '#f2f0eb',
                'panel_from_color' => '#274f3880',
                'panel_to_color' => '#12271cbf',
                'card_bg_color' => '#0a181185',
                'font_body' => 'Montserrat',
                'font_heading' => 'Delius',
            ],
        };

        $custom = is_array($page->unit?->theme) ? $page->unit->theme : [];

        foreach ($defaults as $key => $defaultValue) {
            if (! isset($custom[$key]) || ! is_string($custom[$key]) || trim($custom[$key]) === '') {
                continue;
            }

            $defaults[$key] = trim($custom[$key]);
        }

        return $defaults;
    }

    /**
     * @param  array<string, string>  $palette
     */
    private function buildThemeCssVars(array $palette): string
    {
        $allowed = [
            'primary_color' => '--rt-primary',
            'info_color' => '--rt-info',
            'surface_color' => '--rt-green',
            'white_color' => '--rt-white',
            'dark_color' => '--rt-dark',
            'nav_bg_color' => '--nav-bg',
            'footer_bg_color' => '--footer-bg',
            'hero_overlay_top' => '--hero-overlay-top',
            'hero_overlay_bottom' => '--hero-overlay-bottom',
            'mobile_menu_bg_color' => '--mobile-menu-bg',
            'mobile_menu_text_color' => '--mobile-menu-text',
            'panel_from_color' => '--panel-from',
            'panel_to_color' => '--panel-to',
            'card_bg_color' => '--card-bg',
            'font_body' => '--font-body-custom',
            'font_heading' => '--font-heading-custom',
        ];

        $parts = [];

        foreach ($allowed as $key => $cssVar) {
            if (! isset($palette[$key])) {
                continue;
            }

            $value = str_replace([';', '{', '}'], '', $palette[$key]);
            $parts[] = "{$cssVar}: {$value}";
        }

        return implode('; ', $parts);
    }

    private function whatsappUrlForPage(Page $page): string
    {
        $phone = $page->unit?->contact_whatsapp ?: '+55 47 98808-0041';
        $digits = preg_replace('/\D+/', '', $phone) ?: '5547988080041';
        $text = rawurlencode('Entrei em contato pelo site e gostaria de mais informações.');

        return "https://api.whatsapp.com/send?phone={$digits}&text={$text}";
    }

    /**
     * @return array<string, mixed>
     */
    private function resolveSeoData(Page $page): array
    {
        $keywords = $page->meta_keywords;
        $defaultImage = '/storage/imported/salomao-site/public/capa-2.jpg';

        if ((! is_array($keywords) || $keywords === []) && is_array($page->unit?->seo_keywords)) {
            $keywords = $page->unit->seo_keywords;
        }

        $title = $page->meta_title ?: ($page->unit?->seo_title ?: $page->title);
        $description = $page->meta_description ?: ($page->unit?->seo_description ?: $page->excerpt);
        $canonical = $page->canonical_url ?: $page->unit?->seo_canonical_url;
        $ogImage = $this->assetPathToUrl($page->og_image_path ?: $page->unit?->seo_og_image_path, $defaultImage);
        $twitterImage = $this->assetPathToUrl($page->unit?->seo_twitter_image_path, $ogImage);

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => is_array($keywords) ? $keywords : [],
            'canonical_url' => $canonical,
            'robots' => $page->unit?->seo_robots ?: 'index,follow',
            'author' => $page->unit?->seo_author ?: config('app.name'),
            'locale' => $page->unit?->seo_locale ?: 'pt_BR',
            'og_type' => $page->unit?->seo_og_type ?: 'website',
            'og_title' => $page->unit?->seo_og_title ?: $title,
            'og_description' => $page->unit?->seo_og_description ?: $description,
            'og_image' => $ogImage,
            'twitter_card' => $page->unit?->seo_twitter_card ?: 'summary_large_image',
            'twitter_site' => $page->unit?->seo_twitter_site,
            'twitter_creator' => $page->unit?->seo_twitter_creator,
            'twitter_title' => $page->unit?->seo_twitter_title ?: $title,
            'twitter_description' => $page->unit?->seo_twitter_description ?: $description,
            'twitter_image' => $twitterImage,
            'favicon_ico' => $this->assetPathToUrl($page->unit?->favicon_ico_path, '/favicon.ico'),
            'favicon_16' => $this->assetPathToUrl($page->unit?->favicon_16_path, '/favicon.ico'),
            'favicon_32' => $this->assetPathToUrl($page->unit?->favicon_32_path, '/favicon.ico'),
            'apple_touch_icon' => $this->assetPathToUrl($page->unit?->apple_touch_icon_path, '/favicon.ico'),
        ];
    }

    private function assetPathToUrl(?string $path, string $default): string
    {
        if ($path === null || trim($path) === '') {
            return $default;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return '/storage/'.ltrim($path, '/');
    }
}
