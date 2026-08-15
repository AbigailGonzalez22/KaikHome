<?php

class PageController
{
    public function home(): void
    {
        $activeNav = 'home';
        $pageTitle = 'Kaik Home | Promotora Inmobiliaria en Toledo — Obra Nueva en Bargas y Méntrida';
        $metaDescription = 'Kaik Home, promotora inmobiliaria en Toledo con más de 10 años de experiencia. Descubre nuestras promociones de obra nueva en Bargas y Méntrida.';
        $canonicalPath = '/';
        $ogTitle = 'Kaik Home | Promotora Inmobiliaria en Toledo';
        $ogDescription = 'Más de 10 años de experiencia local con una metodología propia enfocada en la calidad y la transparencia absoluta.';
        $twitterDescription = 'Descubre nuestras promociones de obra nueva en Bargas y Méntrida, Toledo.';
        $ogImage = SITE_URL . '/img/hero-toledo.jpg';
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'RealEstateAgent',
            'name' => 'Kaik Home',
            'image' => $ogImage,
            'url' => SITE_URL . '/',
            'telephone' => '+34687459216',
            'email' => 'comercial@kaikhome.com',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Calle Comercio 12',
                'postalCode' => '45001',
                'addressLocality' => 'Toledo',
                'addressRegion' => 'Toledo',
                'addressCountry' => 'ES',
            ],
            'areaServed' => 'Toledo, España',
        ];

        $contentView = BASE_PATH . '/app/views/pages/home.php';
        $afterFooterView = null;

        require BASE_PATH . '/app/views/layout.php';
    }

    public function bargas(): void
    {
        $activeNav = 'bargas';
        $pageTitle = 'Diana Residencial Bargas | 37 Viviendas de Obra Nueva en Toledo | Kaik Home';
        $metaDescription = 'Diana Residencial en Bargas: 37 viviendas de 1 y 2 plantas con 3 dormitorios y 2 baños. Obra en curso, entrega 2T 2027. Descubre las tipologías.';
        $canonicalPath = '/bargas';
        $ogTitle = 'Diana Residencial Bargas | Kaik Home';
        $ogDescription = '37 viviendas de obra nueva en Bargas, Toledo. Arquitectura moderna y entorno natural privilegiado.';
        $twitterDescription = '37 viviendas de obra nueva en Bargas, Toledo. Obra en curso.';
        $ogImage = SITE_URL . '/img/hero-bargas.jpg';
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'ApartmentComplex',
            'name' => 'Diana Residencial',
            'description' => 'Promoción de 37 viviendas de obra nueva en Bargas, Toledo, con 1 y 2 plantas.',
            'numberOfAccommodationUnits' => 37,
            'image' => $ogImage,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Bargas',
                'addressRegion' => 'Toledo',
                'addressCountry' => 'ES',
            ],
        ];

        $contentView = BASE_PATH . '/app/views/pages/bargas.php';
        $afterFooterView = BASE_PATH . '/app/views/partials/fab-lightbox.php';

        require BASE_PATH . '/app/views/layout.php';
    }

    public function mentrida(): void
    {
        $activeNav = 'mentrida';
        $pageTitle = 'Residencial Méntrida | 24 Viviendas en Construcción, Entrega 2027 | Kaik Home';
        $metaDescription = 'Residencial Méntrida: 24 viviendas de obra nueva en la comarca de Torrijos, Toledo. 60% de obra ejecutada, entrega 1T 2027. Calidades premium.';
        $canonicalPath = '/mentrida';
        $ogTitle = 'Residencial Méntrida | Kaik Home';
        $ogDescription = '24 viviendas en construcción en Méntrida, Toledo. Calidades premium y eficiencia energética superior.';
        $twitterDescription = '24 viviendas en construcción en Méntrida, Toledo. Entrega 1T 2027.';
        $ogImage = SITE_URL . '/img/hero-mentrida.jpg';
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'ApartmentComplex',
            'name' => 'Residencial Méntrida',
            'description' => 'Promoción de 24 viviendas de obra nueva en Méntrida, comarca de Torrijos, Toledo.',
            'numberOfAccommodationUnits' => 24,
            'image' => $ogImage,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Méntrida',
                'addressRegion' => 'Toledo',
                'addressCountry' => 'ES',
            ],
        ];

        $contentView = BASE_PATH . '/app/views/pages/mentrida.php';
        $afterFooterView = BASE_PATH . '/app/views/partials/fab-lightbox.php';

        require BASE_PATH . '/app/views/layout.php';
    }
}
