<?php

/**
 * Cloak-Cloaking 系統配置檔
 */

return [
    // Bot User-Agent 關鍵字列表
    'bot_keywords' => [
        'googlebot',
        'bingbot',
        'facebookexternalhit',
        'crawler',
        'spider',
        'bot',
        'adsbot-google',
        'mediapartners-google',
        'slurp',
        'duckduckbot',
        'baiduspider',
        'yandexbot',
        'sogou',
        'exabot',
        'facebot',
        'ia_archiver',
    ],

    // 頁面檔案路徑配置
    'pages' => [
        'white_page' => 'white_page.html',
        'landing_page' => 'landing_page.html',
    ],

    // 安全配置
    'security' => [
        // 是否啟用 IP 黑名單 (預留擴展位)
        'enable_ip_blacklist' => false,
        // 是否啟用日誌記錄
        'enable_logging' => true,
        'log_file' => 'access.log',
    ],
];
