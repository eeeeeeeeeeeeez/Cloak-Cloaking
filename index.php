<?php

/**
 * Cloak-Cloaking 核心邏輯優化版
 */

// 1. 載入配置
$config = require_once 'config.php';

/**
 * 檢測是否為機器人 (Bot)
 * 
 * @param array $config 系統配置
 * @return bool 是否為機器人
 */
function isBot(array $config): bool {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
    
    if (empty($userAgent)) {
        return true; // 無 User-Agent 通常視為 Bot 或異常請求
    }

    // 使用正規表達式進行高效匹配
    $botKeywords = $config['bot_keywords'];
    $pattern = '/' . implode('|', array_map('preg_quote', $botKeywords)) . '/i';
    
    return (bool) preg_match($pattern, $userAgent);
}

/**
 * 記錄訪問日誌
 * 
 * @param bool $isBot 是否判定為 Bot
 * @param array $config 系統配置
 */
function logAccess(bool $isBot, array $config): void {
    if (!$config['security']['enable_logging']) {
        return;
    }

    $logFile = $config['security']['log_file'];
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'none';
    $time = date('Y-m-d H:i:s');
    $type = $isBot ? '[BOT]' : '[USER]';
    
    $logEntry = sprintf("[%s] %s IP: %s | UA: %s" . PHP_EOL, $time, $type, $ip, $ua);
    
    @file_put_contents($logFile, $logEntry, FILE_APPEND);
}

// --- 執行分流邏輯 ---

$botDetected = isBot($config);

// 記錄日誌
logAccess($botDetected, $config);

// 根據檢測結果選擇頁面
$pageKey = $botDetected ? 'white_page' : 'landing_page';
$targetFile = $config['pages'][$pageKey];

// 安全檢查並包含頁面
if (file_exists($targetFile)) {
    include $targetFile;
} else {
    // 降級處理：如果檔案不存在，返回 404 或顯示基本訊息
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    if (ini_get('display_errors')) {
        echo "<p>Error: Missing file '{$targetFile}'</p>";
    }
}
