@extends('layouts.site')

@section('content')
<section class="hero" style="--hero-bg-image: url('{{ url($heroBackground) }}')">
    <div class="shell hero-inner">
        <img src="{{ $unitLogo }}" alt="Logo" class="unit-logo">
        @php
            $hero = $page->sections->firstWhere('type', 'hero');
            $heroPayload = $hero?->payload ?? [];
        @endphp
        <h1>{{ $hero?->title ?: $page->title }}</h1>
        @if($hero?->subtitle)
            <p>{{ $hero->subtitle }}</p>
        @elseif($unit?->hero_subtitle)
            <p>{{ $unit->hero_subtitle }}</p>
        @endif

        @if(!empty($heroPayload['highlights']) && is_array($heroPayload['highlights']))
            <ul class="highlight-list">
                @foreach($heroPayload['highlights'] as $highlight)
                    <li>{{ $highlight }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</section>

<section class="page-content shell">
    @foreach($page->sections as $section)
        @continue($section->type === 'hero')

        @php $payload = $section->payload ?? []; @endphp

        <article class="content-block">
            <h2>{{ $section->title }}</h2>
            @if($section->subtitle)
                <p class="lead">{{ $section->subtitle }}</p>
            @endif

            @if(in_array($section->type, ['manifesto', 'about-cards', 'services', 'differentials', 'unit-cards']) && !empty($payload['items']) && is_array($payload['items']))
                <div class="cards-grid">
                    @foreach($payload['items'] as $item)
                        <div class="card">
                            @if(is_array($item))
                                <h3>{{ $item['title'] ?? $item['name'] ?? 'Item' }}</h3>
                                @if(!empty($item['text']))
                                    <p>{{ $item['text'] }}</p>
                                @endif
                            @else
                                <p>{{ $item }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if($section->type === 'content' && !empty($payload['whatsapp_url']))
                <a href="{{ $payload['whatsapp_url'] }}" target="_blank" rel="noreferrer" class="btn-primary">Falar no WhatsApp</a>
            @endif

            @if($section->type === 'differentials' && !empty($payload['intro']))
                <p class="lead">{{ $payload['intro'] }}</p>
            @endif

            @if($section->type === 'structure' && !empty($payload['team']) && is_array($payload['team']))
                <h3>Equipe</h3>
                <ul class="chips">
                    @foreach($payload['team'] as $member)
                        <li>{{ $member }}</li>
                    @endforeach
                </ul>
            @endif
        </article>
    @endforeach

    @if($page->template === 'root-units')
        <article class="content-block">
            <h2>Unidades da Rede</h2>
            <div class="cards-grid">
                @foreach($units as $unitCard)
                    <a class="card card-link" href="/{{ $unitCard->slug }}">
                        <h3>{{ $unitCard->name }}</h3>
                        <p>{{ $unitCard->summary }}</p>
                        @if($unitCard->city && $unitCard->state)
                            <p>{{ $unitCard->city }}/{{ $unitCard->state }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </article>
    @endif

    @if($portfolioMedia->isNotEmpty())
        <article class="content-block">
            <h2>Portfólio</h2>
            <div class="gallery-grid">
                @foreach($portfolioMedia as $media)
                    <img src="{{ '/storage/' . $media->path }}" alt="{{ $media->title ?: 'Imagem' }}" loading="lazy">
                @endforeach
            </div>
        </article>
    @endif

    @if($structureMedia->isNotEmpty())
        <article class="content-block">
            <h2>Galeria da Estrutura</h2>
            <div class="gallery-grid">
                @foreach($structureMedia as $media)
                    <img src="{{ '/storage/' . $media->path }}" alt="{{ $media->title ?: 'Imagem da estrutura' }}" loading="lazy">
                @endforeach
            </div>
        </article>
    @endif

    @if($page->diseases->isNotEmpty())
        <article class="content-block">
            <h2>Doenças Atendidas</h2>
            <div class="cards-grid">
                @foreach($page->diseases as $disease)
                    <div class="card">
                        <h3>{{ $disease->title }} @if($disease->code) <small>({{ $disease->code }})</small> @endif</h3>
                        <p>{{ $disease->summary }}</p>
                        @if($disease->description)
                            <p>{{ $disease->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </article>
    @endif

    @if($page->faqs->isNotEmpty())
        <article class="content-block">
            <h2>Perguntas Frequentes</h2>
            <div class="faq-list">
                @foreach($page->faqs as $faq)
                    <details>
                        <summary>{{ $faq->question }}</summary>
                        <p>{{ $faq->answer }}</p>
                    </details>
                @endforeach
            </div>
        </article>
    @endif

    @if($page->materials->isNotEmpty())
        <article class="content-block">
            <h2>Materiais Úteis</h2>
            <div class="cards-grid">
                @foreach($page->materials as $material)
                    <a class="card card-link" href="{{ $material->external_url }}" target="_blank" rel="noreferrer">
                        <h3>{{ $material->title }}</h3>
                        @if($material->summary)
                            <p>{{ $material->summary }}</p>
                        @endif
                        @if($material->description)
                            <p>{{ $material->description }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </article>
    @endif
</section>
@endsection
