<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <meta name="robots" content="{{ $seo['robots'] }}">
    <meta name="author" content="{{ $seo['author'] }}">
    @if(!empty($seo['keywords']))
        <meta name="keywords" content="{{ implode(', ', $seo['keywords']) }}">
    @endif
    @if($seo['canonical_url'])
        <link rel="canonical" href="{{ $seo['canonical_url'] }}">
    @endif
    <meta property="og:type" content="{{ $seo['og_type'] }}">
    <meta property="og:locale" content="{{ $seo['locale'] }}">
    <meta property="og:title" content="{{ $seo['og_title'] }}">
    <meta property="og:description" content="{{ $seo['og_description'] }}">
    <meta property="og:image" content="{{ $seo['og_image'] }}">
    @if($seo['canonical_url'])
        <meta property="og:url" content="{{ $seo['canonical_url'] }}">
    @endif
    <meta name="twitter:card" content="{{ $seo['twitter_card'] }}">
    <meta name="twitter:title" content="{{ $seo['twitter_title'] }}">
    <meta name="twitter:description" content="{{ $seo['twitter_description'] }}">
    <meta name="twitter:image" content="{{ $seo['twitter_image'] }}">
    @if(!empty($seo['twitter_site']))
        <meta name="twitter:site" content="{{ $seo['twitter_site'] }}">
    @endif
    @if(!empty($seo['twitter_creator']))
        <meta name="twitter:creator" content="{{ $seo['twitter_creator'] }}">
    @endif
    <link rel="icon" href="{{ $seo['favicon_ico'] }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $seo['favicon_32'] }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $seo['favicon_16'] }}">
    <link rel="apple-touch-icon" href="{{ $seo['apple_touch_icon'] }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="theme-{{ $theme }}" style="{{ $themeCssVars }}">
<header class="site-header">
    <nav class="site-nav shell">
        <a href="/" class="brand-link">
            <img src="{{ $brandLogo }}" alt="Rede Salomão" class="brand-logo">
        </a>

        <button class="mobile-menu-button" type="button" data-mobile-menu-open aria-label="Abrir menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <ul class="nav-links">
            @php $menu = $unitMenu->isNotEmpty() ? $unitMenu : $rootMenu; @endphp
            @foreach($menu as $item)
                <li><a href="{{ $item->path }}">{{ $item->menu_label }}</a></li>
            @endforeach
            <li><a href="#contato">Contato</a></li>
        </ul>
    </nav>
</header>

<div class="mobile-menu-panel" data-mobile-menu-panel aria-hidden="true">
    <button class="mobile-menu-close" type="button" data-mobile-menu-close aria-label="Fechar menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </button>
    <ul>
        @foreach($menu as $item)
            <li><a href="{{ $item->path }}">{{ $item->menu_label }}</a></li>
        @endforeach
        <li><a href="#contato">Contato</a></li>
    </ul>
</div>

<main class="site-main">
    @yield('content')
</main>

<a class="whatsapp-float" href="{{ $whatsappUrl }}" target="_blank" rel="noreferrer" aria-label="Falar no WhatsApp">
    WhatsApp
</a>

<footer id="contato" class="site-footer">
    <div class="shell footer-grid">
        <div>
            <h3>Contato</h3>
            @if($unit)
                <p>{{ $unit->name }}</p>
                <p>{{ $unit->contact_phone }}</p>
                <p>{{ $unit->contact_email }}</p>
                <p>{{ $unit->address_line }} - {{ $unit->city }}/{{ $unit->state }}</p>
            @else
                <p>Rede Salomão</p>
                <p>contato@redesalomao.com.br</p>
            @endif
        </div>

        <div>
            <h3>Mapa do Site</h3>
            <ul>
                @foreach($rootMenu as $item)
                    <li><a href="{{ $item->path }}">{{ $item->menu_label }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3>Unidades</h3>
            <ul>
                @foreach($units as $footerUnit)
                    <li><a href="/{{ $footerUnit->slug }}">{{ $footerUnit->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
</body>
</html>
