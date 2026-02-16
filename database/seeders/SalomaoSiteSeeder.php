<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Faq;
use App\Models\Material;
use App\Models\Page;
use App\Models\Section;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class SalomaoSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = $this->seedUnits();
        $pages = $this->seedPages($units);

        $this->seedSections($pages);
        $this->seedFaqs($units, $pages);
        $this->seedDiseases($units, $pages);
        $this->seedMaterials($units, $pages);
    }

    /**
     * @return array<string, Unit>
     */
    private function seedUnits(): array
    {
        $data = [
            [
                'name' => 'Residencial Terapêutico Salomão',
                'slug' => 'residencial-terapeutico',
                'code' => 'RT',
                'summary' => 'Ambiente seguro e acolhedor para pessoas com transtornos mentais.',
                'description' => 'Serviço residencial terapêutico com equipe interdisciplinar, cuidado diário e foco em autonomia, dignidade e reinserção social.',
                'hero_title' => 'Respeitando o normal de cada um!',
                'hero_subtitle' => 'Bem-vindo ao Residencial Terapêutico Salomão.',
                'contact_phone' => '+55 47 98808-0041',
                'contact_whatsapp' => '+55 47 98808-0041',
                'contact_email' => 'contato@redesalomao.com.br',
                'address_line' => 'Rua Pedro Léo Menscheim, n. 210',
                'city' => 'Gaspar',
                'state' => 'SC',
                'zip_code' => '89117-805',
                'seo_title' => 'Residencial Terapêutico Salomão',
                'seo_description' => 'Ambiente seguro e acolhedor para pessoas com transtornos mentais.',
                'seo_keywords' => ['residencial terapêutico', 'saúde mental', 'rede salomão'],
                'seo_canonical_url' => 'https://redesalomao.com.br/residencial-terapeutico',
                'seo_robots' => 'index,follow',
                'seo_author' => 'Rede Salomão',
                'seo_locale' => 'pt_BR',
                'seo_og_type' => 'website',
                'seo_og_title' => 'Residencial Terapêutico Salomão',
                'seo_og_description' => 'Ambiente seguro e acolhedor para pessoas com transtornos mentais.',
                'seo_og_image_path' => '/storage/imported/salomao-site/public/capa-2.jpg',
                'seo_twitter_card' => 'summary_large_image',
                'seo_twitter_site' => '@redesalomao',
                'seo_twitter_creator' => '@redesalomao',
                'seo_twitter_title' => 'Residencial Terapêutico Salomão',
                'seo_twitter_description' => 'Ambiente seguro e acolhedor para pessoas com transtornos mentais.',
                'seo_twitter_image_path' => '/storage/imported/salomao-site/public/capa-2.jpg',
                'favicon_ico_path' => '/favicon.ico',
                'favicon_16_path' => '/favicon.ico',
                'favicon_32_path' => '/favicon.ico',
                'apple_touch_icon_path' => '/favicon.ico',
                'theme' => [
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
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Residência Inclusiva Salomão',
                'slug' => 'residencia-inclusiva',
                'code' => 'RI',
                'summary' => 'Acolhimento digno de pessoas portadoras de deficiência.',
                'description' => 'Unidade de residência inclusiva com foco em acessibilidade, autonomia, convivência comunitária e cuidado contínuo.',
                'hero_title' => 'Acolhimento digno',
                'hero_subtitle' => 'de Pessoas Portadoras de Deficiência.',
                'contact_phone' => '+55 47 98808-0041',
                'contact_whatsapp' => '+55 47 98808-0041',
                'contact_email' => 'contato@redesalomao.com.br',
                'address_line' => 'Rua Guilherme Lueders, nº 285',
                'city' => 'Blumenau',
                'state' => 'SC',
                'zip_code' => '89055-470',
                'seo_title' => 'Residência Inclusiva Salomão',
                'seo_description' => 'Acolhimento digno de pessoas portadoras de deficiência.',
                'seo_keywords' => ['residência inclusiva', 'pcd', 'acolhimento'],
                'seo_canonical_url' => 'https://redesalomao.com.br/residencia-inclusiva',
                'seo_robots' => 'index,follow',
                'seo_author' => 'Rede Salomão',
                'seo_locale' => 'pt_BR',
                'seo_og_type' => 'website',
                'seo_og_title' => 'Residência Inclusiva Salomão',
                'seo_og_description' => 'Acolhimento digno de pessoas portadoras de deficiência.',
                'seo_og_image_path' => '/storage/imported/salomao-site/public/capa-2.jpg',
                'seo_twitter_card' => 'summary_large_image',
                'seo_twitter_site' => '@redesalomao',
                'seo_twitter_creator' => '@redesalomao',
                'seo_twitter_title' => 'Residência Inclusiva Salomão',
                'seo_twitter_description' => 'Acolhimento digno de pessoas portadoras de deficiência.',
                'seo_twitter_image_path' => '/storage/imported/salomao-site/public/capa-2.jpg',
                'favicon_ico_path' => '/favicon.ico',
                'favicon_16_path' => '/favicon.ico',
                'favicon_32_path' => '/favicon.ico',
                'apple_touch_icon_path' => '/favicon.ico',
                'theme' => [
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
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Adestramento Salomão',
                'slug' => 'adestramento-salomao',
                'code' => 'AS',
                'summary' => 'Qualidade de vida para você e seu PET.',
                'description' => 'Serviço de adestramento com foco em convivência, bem-estar e integração entre tutor, animal e sociedade.',
                'hero_title' => 'Adestramento Salomão',
                'hero_subtitle' => 'Qualidade de vida para Você e seu PET, para sua Família e para a Sociedade.',
                'contact_phone' => '+55 47 98868-8790',
                'contact_whatsapp' => '+55 47 98868-8790',
                'contact_email' => 'je4n.pw@gmai.com',
                'address_line' => 'Rua Pedro Pedro Zimmermann, n. 2391',
                'city' => 'Blumenau',
                'state' => 'SC',
                'zip_code' => '89068-001',
                'seo_title' => 'Adestramento Salomão',
                'seo_description' => 'Qualidade de vida para você e seu PET.',
                'seo_keywords' => ['adestramento', 'pet', 'comportamento animal'],
                'seo_canonical_url' => 'https://redesalomao.com.br/adestramento-salomao',
                'seo_robots' => 'index,follow',
                'seo_author' => 'Rede Salomão',
                'seo_locale' => 'pt_BR',
                'seo_og_type' => 'website',
                'seo_og_title' => 'Adestramento Salomão',
                'seo_og_description' => 'Qualidade de vida para você e seu PET.',
                'seo_og_image_path' => '/storage/imported/salomao-site/public/capa-2.jpg',
                'seo_twitter_card' => 'summary_large_image',
                'seo_twitter_site' => '@redesalomao',
                'seo_twitter_creator' => '@redesalomao',
                'seo_twitter_title' => 'Adestramento Salomão',
                'seo_twitter_description' => 'Qualidade de vida para você e seu PET.',
                'seo_twitter_image_path' => '/storage/imported/salomao-site/public/capa-2.jpg',
                'favicon_ico_path' => '/favicon.ico',
                'favicon_16_path' => '/favicon.ico',
                'favicon_32_path' => '/favicon.ico',
                'apple_touch_icon_path' => '/favicon.ico',
                'theme' => [
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
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        $units = [];

        foreach ($data as $item) {
            $unit = Unit::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );

            $units[$unit->slug] = $unit;
        }

        return $units;
    }

    /**
     * @param  array<string, Unit>  $units
     * @return array<string, Page>
     */
    private function seedPages(array $units): array
    {
        $baseKeywords = [
            'Residencial Terapêutico',
            'Transtornos Mentais',
            'Residencial',
            'desospitalização',
            'antimanicomial',
            'raps',
            'rede de atenção psicossocial',
        ];

        $data = [
            ['title' => 'Início', 'slug' => 'inicio', 'path' => '/', 'menu_label' => 'Início', 'template' => 'root-home', 'meta_title' => 'Residencial Terapêutico Salomão', 'meta_description' => 'Respeitando o normal de cada um.', 'meta_keywords' => $baseKeywords, 'canonical_url' => 'https://redesalomao.com.br/', 'is_home' => true, 'sort_order' => 1],
            ['title' => 'Sobre', 'slug' => 'sobre', 'path' => '/sobre', 'menu_label' => 'Sobre', 'template' => 'root-about', 'meta_title' => 'Sobre - Rede Salomão', 'meta_description' => 'Uma rede de cuidado e acolhimento.', 'meta_keywords' => array_merge($baseKeywords, ['sobre nós']), 'canonical_url' => 'https://redesalomao.com.br/sobre', 'sort_order' => 2],
            ['title' => 'Unidades', 'slug' => 'unidades', 'path' => '/unidades', 'menu_label' => 'Unidades', 'template' => 'root-units', 'meta_title' => 'Unidades - Rede Salomão', 'meta_description' => 'Conheça a estrutura de cuidado e valorização que oferecemos.', 'meta_keywords' => array_merge($baseKeywords, ['unidades']), 'canonical_url' => 'https://redesalomao.com.br/unidades', 'sort_order' => 3],
            ['title' => 'Saiba Mais', 'slug' => 'saibamais', 'path' => '/saibamais', 'menu_label' => 'Saiba Mais', 'template' => 'rt-saibamais', 'meta_title' => 'Saiba Mais - Residencial Terapêutico Salomão', 'meta_description' => 'Os transtornos podem ser controlados e organizados!', 'meta_keywords' => array_merge($baseKeywords, ['contato', 'portifólio']), 'canonical_url' => 'https://redesalomao.com.br/saibamais', 'unit_slug' => 'residencial-terapeutico', 'sort_order' => 4],

            ['title' => 'Residencial Terapêutico', 'slug' => 'home', 'path' => '/residencial-terapeutico', 'menu_label' => 'Início', 'template' => 'rt-home', 'meta_title' => 'Residencial Terapêutico Salomão', 'meta_description' => 'Respeitando o normal de cada um.', 'meta_keywords' => $baseKeywords, 'canonical_url' => 'https://redesalomao.com.br/residencial-terapeutico', 'unit_slug' => 'residencial-terapeutico', 'sort_order' => 1],
            ['title' => 'Doenças Atendidas', 'slug' => 'doencas', 'path' => '/residencial-terapeutico/doencas', 'menu_label' => 'Doenças Atendidas', 'template' => 'rt-diseases', 'meta_title' => 'Doenças Atendidas - Residencial Terapêutico Salomão', 'meta_description' => 'Transtornos psicóticos atendidos no Residencial Salomão.', 'meta_keywords' => array_merge($baseKeywords, ['doenças atendidas']), 'canonical_url' => 'https://redesalomao.com.br/residencial-terapeutico/doencas', 'unit_slug' => 'residencial-terapeutico', 'sort_order' => 2],
            ['title' => 'Estrutura', 'slug' => 'estrutura', 'path' => '/residencial-terapeutico/estrutura', 'menu_label' => 'Estrutura', 'template' => 'rt-structure', 'meta_title' => 'Estrutura - Residencial Terapêutico Salomão', 'meta_description' => 'Imagens do Residencial Terapêutico Salomão.', 'meta_keywords' => array_merge($baseKeywords, ['estrutura']), 'canonical_url' => 'https://redesalomao.com.br/residencial-terapeutico/estrutura', 'unit_slug' => 'residencial-terapeutico', 'sort_order' => 3],
            ['title' => 'Dúvidas Frequentes', 'slug' => 'faq', 'path' => '/residencial-terapeutico/faq', 'menu_label' => 'Dúvidas Frequentes', 'template' => 'rt-faq', 'meta_title' => 'Dúvidas Frequentes - Residencial Terapêutico Salomão', 'meta_description' => 'Respostas para suas perguntas.', 'meta_keywords' => array_merge($baseKeywords, ['faq']), 'canonical_url' => 'https://redesalomao.com.br/faq', 'unit_slug' => 'residencial-terapeutico', 'sort_order' => 4],
            ['title' => 'Materiais Úteis', 'slug' => 'materiais', 'path' => '/residencial-terapeutico/materiais', 'menu_label' => 'Materiais', 'template' => 'rt-materials', 'meta_title' => 'Materiais úteis - Residencial Terapêutico Salomão', 'meta_description' => 'Materiais sobre Residência Terapêutica.', 'meta_keywords' => array_merge($baseKeywords, ['materiais']), 'canonical_url' => 'https://redesalomao.com.br/materiais', 'unit_slug' => 'residencial-terapeutico', 'sort_order' => 5],

            ['title' => 'Residência Inclusiva', 'slug' => 'home', 'path' => '/residencia-inclusiva', 'menu_label' => 'Início', 'template' => 'ri-home', 'meta_title' => 'Residência Inclusiva Salomão', 'meta_description' => 'Acolhimento digno de pessoas portadoras de deficiência.', 'meta_keywords' => array_merge($baseKeywords, ['residência inclusiva', 'pcd']), 'canonical_url' => 'https://redesalomao.com.br/residencia-inclusiva', 'unit_slug' => 'residencia-inclusiva', 'sort_order' => 1],
            ['title' => 'Estrutura', 'slug' => 'estrutura', 'path' => '/residencia-inclusiva/estrutura', 'menu_label' => 'Estrutura', 'template' => 'ri-structure', 'meta_title' => 'Estrutura - Residência Inclusiva Salomão', 'meta_description' => 'Imagens da Residência Inclusiva Salomão.', 'meta_keywords' => array_merge($baseKeywords, ['estrutura', 'residência inclusiva']), 'canonical_url' => 'https://redesalomao.com.br/residencia-inclusiva/estrutura', 'unit_slug' => 'residencia-inclusiva', 'sort_order' => 2],

            ['title' => 'Adestramento Salomão', 'slug' => 'home', 'path' => '/adestramento-salomao', 'menu_label' => 'Início', 'template' => 'as-home', 'meta_title' => 'Adestramento Salomão', 'meta_description' => 'Qualidade de vida para Você e seu PET.', 'meta_keywords' => ['adestramento', 'pet', 'qualidade de vida'], 'canonical_url' => 'https://redesalomao.com.br/adestramento-salomao', 'unit_slug' => 'adestramento-salomao', 'sort_order' => 1],
            ['title' => 'Doenças Atendidas', 'slug' => 'doencas', 'path' => '/adestramento-salomao/doencas', 'menu_label' => 'Doenças Atendidas', 'template' => 'as-diseases', 'meta_title' => 'Doenças Atendidas - Adestramento Salomão', 'meta_description' => 'Conteúdo de referência sobre transtornos atendidos.', 'meta_keywords' => array_merge($baseKeywords, ['doenças atendidas']), 'canonical_url' => 'https://redesalomao.com.br/adestramento-salomao/doencas', 'unit_slug' => 'adestramento-salomao', 'sort_order' => 2],
            ['title' => 'Estrutura', 'slug' => 'estrutura', 'path' => '/adestramento-salomao/estrutura', 'menu_label' => 'Estrutura', 'template' => 'as-structure', 'meta_title' => 'Estrutura - Adestramento Salomão', 'meta_description' => 'Imagens do Adestramento Salomão.', 'meta_keywords' => ['adestramento', 'estrutura'], 'canonical_url' => 'https://redesalomao.com.br/adestramento-salomao/estrutura', 'unit_slug' => 'adestramento-salomao', 'sort_order' => 3],
            ['title' => 'Dúvidas Frequentes', 'slug' => 'faq', 'path' => '/adestramento-salomao/faq', 'menu_label' => 'Dúvidas Frequentes', 'template' => 'as-faq', 'meta_title' => 'Dúvidas Frequentes - Adestramento Salomão', 'meta_description' => 'Respostas para suas perguntas.', 'meta_keywords' => ['adestramento', 'faq'], 'canonical_url' => 'https://redesalomao.com.br/adestramento-salomao/faq', 'unit_slug' => 'adestramento-salomao', 'sort_order' => 4],
            ['title' => 'Materiais Úteis', 'slug' => 'materiais', 'path' => '/adestramento-salomao/materiais', 'menu_label' => 'Materiais', 'template' => 'as-materials', 'meta_title' => 'Materiais úteis - Adestramento Salomão', 'meta_description' => 'Materiais úteis para referência.', 'meta_keywords' => ['adestramento', 'materiais'], 'canonical_url' => 'https://redesalomao.com.br/adestramento-salomao/materiais', 'unit_slug' => 'adestramento-salomao', 'sort_order' => 5],
        ];

        $pages = [];

        foreach ($data as $item) {
            $unitSlug = $item['unit_slug'] ?? null;
            unset($item['unit_slug']);

            if ($unitSlug !== null) {
                $item['unit_id'] = $units[$unitSlug]->id;
            }

            $item['is_published'] = true;
            $item['published_at'] = now();

            $page = Page::updateOrCreate(
                ['path' => $item['path']],
                $item
            );

            $pages[$page->path] = $page;
        }

        return $pages;
    }

    /**
     * @param  array<string, Page>  $pages
     */
    private function seedSections(array $pages): void
    {
        $sectionsByPath = [
            '/' => [
                [
                    'type' => 'hero',
                    'key' => 'home-hero',
                    'title' => 'Juntos somos mais fortes!',
                    'subtitle' => 'Bem-vindo à Rede Salomão, criada para oferecer serviços acolhedores inclusivos e qualificados.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
                [
                    'type' => 'manifesto',
                    'key' => 'sobre-cards',
                    'title' => 'Somos uma rede comprometida com o bem-estar, a inclusão e a construção de vínculos humanos sólidos.',
                    'payload' => [
                        'items' => [
                            [
                                'title' => 'Residenciais Terapêuticos',
                                'text' => 'Proporcionamos ambientes residenciais terapêuticos estruturados, fundamentados no cuidado integral, no respeito à dignidade humana e no compromisso com a qualidade de vida.',
                            ],
                            [
                                'title' => 'Residenciais Inclusivos',
                                'text' => 'Oferecemos residenciais inclusivos para pessoas com deficiência, promovendo acessibilidade, autonomia e valorização da diversidade humana.',
                            ],
                            [
                                'title' => 'ILPIs',
                                'text' => 'Em breve vamos oferecer Instituições de Longa Permanência, assegurando domicílio coletivo pautado na liberdade, dignidade e cidadania.',
                            ],
                        ],
                    ],
                    'sort_order' => 2,
                ],
            ],
            '/sobre' => [
                [
                    'type' => 'hero',
                    'key' => 'sobre-hero',
                    'title' => 'Quem somos',
                    'subtitle' => 'Uma rede de cuidado e acolhimento que valoriza a dignidade, o respeito e a vida em todas as suas fases.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
            '/unidades' => [
                [
                    'type' => 'hero',
                    'key' => 'unidades-hero',
                    'title' => 'Nossas Unidades',
                    'subtitle' => 'Conheça a estrutura de cuidado e valorização que oferecemos.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
                [
                    'type' => 'unit-cards',
                    'key' => 'unidades-cards',
                    'title' => 'Unidades em destaque',
                    'payload' => [
                        'items' => [
                            [
                                'name' => 'Unidade Belchior Alto',
                                'text' => 'A unidade localizada no bairro Belchior Alto, na cidade de Gaspar/SC, dispõe de 10 vagas na modalidade de Residência Terapêutica nível 1.',
                            ],
                            [
                                'name' => 'Residência Inclusiva',
                                'text' => 'Inaugurada em dezembro de 2025, é uma unidade de residência especializada em pessoas portadoras de deficiências físicas.',
                            ],
                        ],
                    ],
                    'sort_order' => 2,
                ],
            ],
            '/saibamais' => [
                [
                    'type' => 'hero',
                    'key' => 'saibamais-hero',
                    'title' => 'Nosso Portifólio',
                    'subtitle' => 'Os transtornos podem ser controlados e organizados.',
                    'payload' => [
                        'highlights' => [
                            'Existimos para amenizar o sofrimento de famílias vítimas de transtorno mental.',
                            'Os transtornos podem ser controlados e organizados!',
                            'Possuímos uma equipe capacitada para estabilizar e cuidar de forma humanizada das pessoas sob nossa responsabilidade.',
                            'Vagas limitadas abertas.',
                        ],
                        'whatsapp_url' => 'https://api.whatsapp.com/send?phone=5547988080041&text=Entrei%20em%20contato%20pelo%20novo%20site.%20Gostaria%20de%20conversar%20sobre%20o%20residencial.',
                    ],
                    'sort_order' => 1,
                ],
                [
                    'type' => 'content',
                    'key' => 'saibamais-sobre',
                    'title' => 'Sobre Salomão',
                    'subtitle' => 'O Serviço Residencial Terapêutico Salomão foi criado para oferecer um ambiente seguro e acolhedor à pacientes com transtornos mentais egressos ou não de internações psiquiátricas e hospitais de custódia.',
                    'payload' => [],
                    'sort_order' => 2,
                ],
                [
                    'type' => 'content',
                    'key' => 'saibamais-como-chegar',
                    'title' => 'Como Chegar',
                    'subtitle' => 'Rua Pedro Leo Meinschen, 210 - Belchior Alto - Gaspar - Santa Catarina',
                    'payload' => [],
                    'sort_order' => 3,
                ],
            ],
            '/residencial-terapeutico' => [
                [
                    'type' => 'hero',
                    'key' => 'rt-hero',
                    'title' => 'Respeitando o normal de cada um!',
                    'subtitle' => 'Bem-vindo ao Residencial Terapêutico Salomão, criado para oferecer um ambiente seguro e acolhedor à pacientes com transtornos mentais egressos de internações psiquiátricas e hospitais de custódia.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
                [
                    'type' => 'about-cards',
                    'key' => 'rt-sobre-nos',
                    'title' => 'Sobre Nós',
                    'payload' => [
                        'items' => [
                            'O Residencial foi pensado a partir da necessidade que vimos em ter um serviço em nosso território a fim de complementar a Rede de Atenção Psicossocial.',
                            'Esse trabalho visa fazer parte da luta antimanicomial que busca restabelecer os valores morais, éticos, comportamentais e espirituais, direcionando-os a reabilitação social e cultural.',
                            'Visa ainda promover dignidade, direito à cidadania, à liberdade e a autonomia desses sujeitos.',
                        ],
                    ],
                    'sort_order' => 2,
                ],
                [
                    'type' => 'services',
                    'key' => 'rt-servicos',
                    'title' => 'Nossos Serviços',
                    'payload' => [
                        'items' => [
                            ['title' => 'Atendimento Individualizado', 'text' => 'Avaliação completa desde a admissão para entender histórico, diagnóstico, condições atuais e objetivos de cada residente.'],
                            ['title' => 'Autogestão e Gestão Comunitária', 'text' => 'Participação ativa dos moradores no plano de cuidados e nas decisões pessoais e comunitárias.'],
                            ['title' => 'Acompanhamento', 'text' => 'Compromisso com dignidade, respeito e eficácia no cuidado diário.'],
                        ],
                    ],
                    'sort_order' => 3,
                ],
                [
                    'type' => 'differentials',
                    'key' => 'rt-diferenciais',
                    'title' => 'Nossos Diferenciais',
                    'payload' => [
                        'intro' => 'O programa de atividades é construído após criteriosa avaliação respeitando as necessidades de cada morador.',
                        'items' => [
                            'Acolhimento humanizado',
                            'Serviços de Psicologia aos familiares',
                            'Acompanhamento na Rede de Apoio Psicosocial',
                            'Arteterapia',
                            'Musicoterapia',
                            'Atualização da rotina da casa com fotos e vídeos em grupo do Whatsapp',
                        ],
                    ],
                    'sort_order' => 4,
                ],
                [
                    'type' => 'structure',
                    'key' => 'rt-estrutura',
                    'title' => 'Conheça a Nossa Estrutura',
                    'subtitle' => 'De acordo com a Portaria GM/MS Nº 3.090/2011 a estrutura do Residencial Salomão foi pensada para proporcionar uma residência completa aos moradores.',
                    'payload' => [
                        'team' => ['coordenação', 'assistente social', 'psicólogas', 'cozinheiro', 'cuidadores em saúde', 'musicoterapeuta'],
                        'details' => 'Amplo espaço com privacidade e respeito à individualidade de cada morador.',
                    ],
                    'sort_order' => 5,
                ],
            ],
            '/residencial-terapeutico/doencas' => [
                [
                    'type' => 'hero',
                    'key' => 'rt-doencas',
                    'title' => 'Doenças Atendidas',
                    'subtitle' => 'Os transtornos psicóticos são o principal enfoque do Residencial Salomão.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
            '/residencial-terapeutico/estrutura' => [
                [
                    'type' => 'hero',
                    'key' => 'rt-estrutura-galeria',
                    'title' => 'Imagens do Residencial Terapêutico Salomão',
                    'payload' => ['gallery_source' => 'app/images/rt/estrutura'],
                    'sort_order' => 1,
                ],
            ],
            '/residencial-terapeutico/faq' => [
                [
                    'type' => 'hero',
                    'key' => 'rt-faq',
                    'title' => 'Perguntas Frequentes',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
            '/residencial-terapeutico/materiais' => [
                [
                    'type' => 'hero',
                    'key' => 'rt-materiais',
                    'title' => 'Materiais Úteis',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
            '/residencia-inclusiva' => [
                [
                    'type' => 'hero',
                    'key' => 'ri-hero',
                    'title' => 'Acolhimento digno de Pessoas Portadoras de Deficiência',
                    'subtitle' => 'Bem-vindo à Residência Inclusiva Salomão, um espaço seguro, humano e respeitoso.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
                [
                    'type' => 'about-cards',
                    'key' => 'ri-sobre-nos',
                    'title' => 'Sobre Nós',
                    'payload' => [
                        'items' => [
                            'O residencial nasceu da percepção de que nosso território precisava de um espaço inclusivo, capaz de acolher pessoas em suas singularidades.',
                            'Compromisso com cuidado em liberdade, acolhimento, respeito e pertencimento.',
                            'Acompanhamento diário por equipe preparada, aliado aos cuidados de saúde quando indicados.',
                        ],
                    ],
                    'sort_order' => 2,
                ],
            ],
            '/residencia-inclusiva/estrutura' => [
                [
                    'type' => 'hero',
                    'key' => 'ri-estrutura-galeria',
                    'title' => 'Imagens da Residencia Inclusiva Salomão',
                    'payload' => ['gallery_source' => 'app/images/ri/estrutura'],
                    'sort_order' => 1,
                ],
            ],
            '/adestramento-salomao' => [
                [
                    'type' => 'hero',
                    'key' => 'as-hero',
                    'title' => 'Adestramento Salomão',
                    'subtitle' => 'Qualidade de vida para Você e seu PET, para sua Família e para a Sociedade.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
            '/adestramento-salomao/doencas' => [
                [
                    'type' => 'hero',
                    'key' => 'as-doencas',
                    'title' => 'Doenças Atendidas',
                    'subtitle' => 'Conteúdo de referência reutilizado na versão inicial.',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
            '/adestramento-salomao/estrutura' => [
                [
                    'type' => 'hero',
                    'key' => 'as-estrutura-galeria',
                    'title' => 'Imagens do Adestramento Salomão',
                    'payload' => ['gallery_source' => 'app/images/as/estrutura'],
                    'sort_order' => 1,
                ],
            ],
            '/adestramento-salomao/faq' => [
                [
                    'type' => 'hero',
                    'key' => 'as-faq',
                    'title' => 'Perguntas Frequentes',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
            '/adestramento-salomao/materiais' => [
                [
                    'type' => 'hero',
                    'key' => 'as-materiais',
                    'title' => 'Materiais Úteis',
                    'payload' => [],
                    'sort_order' => 1,
                ],
            ],
        ];

        foreach ($sectionsByPath as $path => $sections) {
            $page = $pages[$path] ?? null;

            if ($page === null) {
                continue;
            }

            Section::query()->where('page_id', $page->id)->delete();

            foreach ($sections as $section) {
                $page->sections()->create($section);
            }
        }
    }

    /**
     * @param  array<string, Unit>  $units
     * @param  array<string, Page>  $pages
     */
    private function seedFaqs(array $units, array $pages): void
    {
        $faqs = [
            [
                'question' => 'É um lar de idosos?',
                'answer' => 'Um Residencial Terapêutico não é um lar de idosos. Embora possa acolher pessoas de diferentes idades, seu foco é atender pessoas com transtornos mentais graves, oferecendo suporte para autonomia e qualidade de vida.',
            ],
            [
                'question' => 'É uma clínica psiquiátrica?',
                'answer' => 'Ao contrário de uma clínica, não há internações de curto ou longo prazo para tratamentos médicos intensivos. O Residencial Terapêutico oferece moradia contínua com suporte especializado e reintegração social.',
            ],
            [
                'question' => 'É uma comunidade terapêutica?',
                'answer' => 'Diferente de comunidades terapêuticas voltadas à dependência de substâncias, o Residencial Terapêutico acolhe pessoas com transtornos mentais que não podem retornar às famílias ou precisam de suporte diário após alta hospitalar.',
            ],
            [
                'question' => 'Então, o que é um Residencial Terapêutico?',
                'answer' => 'É uma moradia assistida para pessoas com transtornos mentais, oferecendo ambiente estruturado e seguro com equipe multidisciplinar especializada para garantir dignidade, autonomia e reinserção social.',
            ],
            [
                'question' => 'Meu familiar está em surto psiquiátrico. Posso acionar o residencial?',
                'answer' => 'O residencial atende pacientes estáveis. Em caso de surto, o paciente deve ser encaminhado via SAMU para serviço de emergência, estabilizado e posteriormente direcionado ao Serviço de Residência Terapêutica.',
            ],
        ];

        $targets = [
            ['unit' => 'residencial-terapeutico', 'page' => '/residencial-terapeutico/faq'],
            ['unit' => 'adestramento-salomao', 'page' => '/adestramento-salomao/faq'],
        ];

        foreach ($targets as $target) {
            $unit = $units[$target['unit']];
            $page = $pages[$target['page']];

            Faq::query()
                ->where('unit_id', $unit->id)
                ->where('page_id', $page->id)
                ->delete();

            foreach ($faqs as $index => $faq) {
                Faq::create([
                    'unit_id' => $unit->id,
                    'page_id' => $page->id,
                    'category' => 'geral',
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }

    /**
     * @param  array<string, Unit>  $units
     * @param  array<string, Page>  $pages
     */
    private function seedDiseases(array $units, array $pages): void
    {
        $diseases = [
            [
                'title' => 'Esquizofrenia',
                'code' => 'F20.-',
                'summary' => 'Disfunções cognitivas, comportamentais e emocionais com impacto social e ocupacional.',
                'description' => 'Transtorno com grande variabilidade clínica que pode incluir delírios, alucinações, discurso desorganizado e alterações do comportamento.',
                'details' => [
                    'A esquizofrenia envolve uma gama de disfunções cognitivas, comportamentais e emocionais.',
                    'Podem ocorrer ideias de referência, experiências perceptivas raras, retraimento social e alterações de humor.',
                    'Déficits cognitivos e baixa consciência de doença podem impactar adesão ao tratamento.',
                ],
            ],
            [
                'title' => 'Transtornos delirantes persistentes',
                'code' => 'F22.-',
                'summary' => 'Presença de delírios persistentes por pelo menos um mês.',
                'description' => 'O transtorno delirante pode gerar prejuízos sociais e ocupacionais com comportamento não necessariamente bizarro.',
                'details' => [
                    'Prejuízos psicossociais podem ser mais circunscritos que na esquizofrenia.',
                    'Humor irritável e comportamento litigioso podem ocorrer em alguns subtipos.',
                ],
            ],
            [
                'title' => 'Transtornos psicóticos agudos e transitórios',
                'code' => 'F23.-',
                'summary' => 'Aparecimento súbito de sintomas psicóticos positivos.',
                'description' => 'Episódios com início abrupto e duração breve, podendo exigir supervisão devido ao prejuízo funcional agudo.',
                'details' => [
                    'Podem incluir delírios, alucinações, discurso desorganizado e alteração psicomotora.',
                    'Há risco aumentado de comportamento suicida durante o episódio agudo.',
                ],
            ],
            [
                'title' => 'Transtorno Afetivo Bipolar',
                'code' => 'F31.-',
                'summary' => 'Episódios recorrentes de humor com prejuízo funcional.',
                'description' => 'Transtorno com episódios depressivos e hipomaníacos/maníacos, podendo incluir sintomas psicóticos.',
                'details' => [
                    'Impulsividade pode contribuir para risco de suicídio e uso de substâncias.',
                    'Pode haver episódios psicóticos congruentes ou incongruentes com o humor.',
                    'Catatonia pode ocorrer em episódios maníacos ou depressivos.',
                ],
            ],
            [
                'title' => 'Transtornos esquizoafetivos',
                'code' => 'F25.-',
                'summary' => 'Sintomas psicóticos com episódios de humor associados.',
                'description' => 'Exige avaliação de período ininterrupto da doença com sintomas psicóticos e depressivos ou maníacos.',
                'details' => [
                    'Pode haver prejuízo ocupacional, isolamento social e dificuldades de autocuidado.',
                    'Risco aumentado de episódios de humor e tentativa de suicídio.',
                ],
            ],
            [
                'title' => 'Episódio depressivo grave',
                'code' => 'F32.3',
                'summary' => 'Sintomas depressivos graves com possível psicose.',
                'description' => 'Quadro depressivo com sofrimento clínico significativo e possível presença de delírios e alucinações.',
                'details' => [
                    'Delírios e alucinações podem ser coerentes ou não com temas depressivos.',
                ],
            ],
            [
                'title' => 'Psicose alucinatória crônica',
                'code' => 'F29',
                'summary' => 'Sintomas psicóticos com prejuízo funcional relevante.',
                'description' => 'Condição psicótica que causa sofrimento e prejuízo social/ocupacional sem preencher critérios de outros transtornos específicos.',
                'details' => [],
            ],
            [
                'title' => 'Outros transtornos psicóticos não-orgânicos',
                'code' => 'F28',
                'summary' => 'Transtornos alucinatórios ou delirantes com desorganização do pensamento.',
                'description' => 'Condição com alterações de pensamento e personalidade que impactam significativamente o funcionamento do indivíduo.',
                'details' => [],
            ],
        ];

        $targets = [
            ['unit' => 'residencial-terapeutico', 'page' => '/residencial-terapeutico/doencas'],
            ['unit' => 'adestramento-salomao', 'page' => '/adestramento-salomao/doencas'],
        ];

        foreach ($targets as $target) {
            $unit = $units[$target['unit']];
            $page = $pages[$target['page']];

            Disease::query()
                ->where('unit_id', $unit->id)
                ->where('page_id', $page->id)
                ->delete();

            foreach ($diseases as $index => $disease) {
                Disease::create([
                    'unit_id' => $unit->id,
                    'page_id' => $page->id,
                    'title' => $disease['title'],
                    'code' => $disease['code'],
                    'summary' => $disease['summary'],
                    'description' => $disease['description'],
                    'details' => $disease['details'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }

    /**
     * @param  array<string, Unit>  $units
     * @param  array<string, Page>  $pages
     */
    private function seedMaterials(array $units, array $pages): void
    {
        $materials = [
            [
                'title' => 'PORTARIA Nº 106, DE 11 DE FEVEREIRO DE 2000',
                'summary' => 'Cria o Serviço Residencial Terapêutico e norteia seu funcionamento.',
                'description' => 'Emitido pelo Ministério da Saúde, esse documento estabelece as bases do Serviço Residencial Terapêutico.',
                'external_url' => 'https://cetadobserva.ufba.br/sites/cetadobserva.ufba.br/files/106_0.pdf',
            ],
            [
                'title' => 'PORTARIA Nº 3.090, DE 23 DE DEZEMBRO DE 2011',
                'summary' => 'Dispõe sobre custeio e implementação dos Serviços Residenciais Terapêuticos.',
                'description' => 'Altera a Portaria nº 106/GM/MS e organiza o repasse de recursos para implantação e funcionamento dos SRT.',
                'external_url' => 'https://bvsms.saude.gov.br/bvs/saudelegis/gm/2011/prt3090_23_12_2011_rep.html',
            ],
        ];

        $targets = [
            ['unit' => 'residencial-terapeutico', 'page' => '/residencial-terapeutico/materiais'],
            ['unit' => 'adestramento-salomao', 'page' => '/adestramento-salomao/materiais'],
        ];

        foreach ($targets as $target) {
            $unit = $units[$target['unit']];
            $page = $pages[$target['page']];

            Material::query()
                ->where('unit_id', $unit->id)
                ->where('page_id', $page->id)
                ->delete();

            foreach ($materials as $index => $material) {
                Material::create([
                    'unit_id' => $unit->id,
                    'page_id' => $page->id,
                    'title' => $material['title'],
                    'summary' => $material['summary'],
                    'description' => $material['description'],
                    'external_url' => $material['external_url'],
                    'published_at' => now(),
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
