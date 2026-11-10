<?php
/**
 * Layanan & tech stack.
 * level: 1 = Dasar, 2 = Menengah, 3 = Mahir, null = tidak ditampilkan.
 * Isi level sesuai kemampuan NYATA. Hapus item networking/tools yang tidak dikuasai.
 */
return [
    'services' => [
        [
            'icon'  => 'code',
            'title' => 'Web Development',
            'desc'  => 'Website profil usaha, landing page, dan sistem informasi berbasis PHP yang cepat dibuka di HP dan mudah dikelola.',
            'tags'  => ['HTML', 'CSS', 'JavaScript', 'Bootstrap', 'PHP'],
        ],
        [
            'icon'  => 'network',
            'title' => 'Network & Infrastructure',
            'desc'  => 'Instalasi LAN/WLAN, konfigurasi router, server, dan troubleshooting agar jaringan kantor atau sekolah stabil.',
            'tags'  => ['Routing', 'LAN/WLAN', 'Linux Server'],
        ],
    ],

    'tech' => [
        // Wajib (Programming)
        ['name' => 'HTML5',      'abbr' => 'HTML', 'color' => '#E34F26', 'cat' => 'programming', 'level' => null, 'use' => 'Struktur halaman semantik & aksesibel'],
        ['name' => 'CSS3',       'abbr' => 'CSS',  'color' => '#1572B6', 'cat' => 'programming', 'level' => null, 'use' => 'Layout Flexbox/Grid, animasi, responsif'],
        ['name' => 'JavaScript', 'abbr' => 'JS',   'color' => '#F7DF1E', 'cat' => 'programming', 'level' => null, 'use' => 'Interaktivitas, DOM, Fetch API'],
        ['name' => 'Bootstrap',  'abbr' => 'B',    'color' => '#7952B3', 'cat' => 'programming', 'level' => null, 'use' => 'Prototipe & UI responsif yang cepat'],
        ['name' => 'PHP',        'abbr' => 'PHP',  'color' => '#777BB4', 'cat' => 'programming', 'level' => null, 'use' => 'Backend, sistem informasi, form & database'],
        // Networking (sesuaikan)
        ['name' => 'Routing & Switching', 'abbr' => 'RS',  'color' => '#34D399', 'cat' => 'networking', 'level' => null, 'use' => 'Konfigurasi router & switch'],
        ['name' => 'LAN / WLAN',          'abbr' => 'LAN', 'color' => '#34D399', 'cat' => 'networking', 'level' => null, 'use' => 'Instalasi kabel & Wi-Fi kantor/sekolah'],
        ['name' => 'Linux Server',        'abbr' => 'LX',  'color' => '#34D399', 'cat' => 'networking', 'level' => null, 'use' => 'Ubuntu Server, Nginx, layanan web'],
        // Tools (sesuaikan)
        ['name' => 'MySQL',      'abbr' => 'SQL', 'color' => '#4479A1', 'cat' => 'tools', 'level' => null, 'use' => 'Basis data aplikasi'],
        ['name' => 'Git & GitHub','abbr' => 'Git', 'color' => '#F05032', 'cat' => 'tools', 'level' => null, 'use' => 'Version control & kolaborasi'],
    ],
];
