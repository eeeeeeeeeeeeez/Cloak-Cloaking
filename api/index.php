<?php

/**
 * Cloak-Cloaking Vercel 優化版
 * 支援環境變數動態配置真實跳轉網址
 */

// 1. 載入配置
$config = require_once 'config.php';

/**
 * 檢測是否為機器人 (Bot)
 */
function isBot(array $config): bool {
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    if (empty($userAgent)) {
        return true; 
    }

    $botKeywords = $config['bot_keywords'];
    $pattern = '/' . implode('|', array_map('preg_quote', $botKeywords)) . '/i';
    
    return (bool) preg_match($pattern, $userAgent);
}

// --- 執行分流邏輯 ---

$botDetected = isBot($config);

if ($botDetected) {
    // 機器人或審核員：展示白頁內容
    $whitePagePath = __DIR__ . '/../' . $config['pages']['white_page'];
    
    if (file_exists($whitePagePath)) {
        include $whitePagePath;
    } else {
        echo "<html><body><h1>Welcome to our Service</h1><p>We provide high-quality solutions for your business.</p></body></html>";
    }
} else {
    // 真實用戶：執行跳轉或展示黑頁
    
    // 優先讀取環境變數 REAL_LANDING_URL
    $realUrl = getenv('REAL_LANDING_URL');

    if ($realUrl) {
        // 如果配置了環境變數，執行 302 重定向
        header("Location: " . $realUrl, true, 302);
        exit;
    } else {
        // 如果沒有環境變數，展示本地的 landing_page.html
        $landingPagePath = __DIR__ . '/../' . $config['pages']['landing_page'];
        if (file_exists($landingPagePath)) {
            include $landingPagePath;
        } else {
            echo "<h1>Site Maintenance</h1><p>Please come back later.</p>";
        }
    }
}
