# 廣告斗篷系統 (Cloak System) - 優化版

這是一個經過優化後的 **廣告流量識別與訪問分流系統** 示例專案。

## 🚀 優化特性

1.  **配置分離**: 將 Bot 列表與核心邏輯分離至 `config.php`，方便維護。
2.  **高效檢測**: 使用正規表達式一次性匹配 User-Agent，提升檢測性能。
3.  **日誌追蹤**: 內建訪問日誌功能，記錄 IP、時間與 User-Agent，方便分析流量。
4.  **安全增強**: 
    *   增加空 User-Agent 檢測。
    *   包含檔案前的存在性檢查，防止報錯。
    *   支援更多常見廣告與搜尋引擎 Bot。
5.  **代碼規範**: 遵循 PSR 風格，邏輯更清晰。

## 📁 專案結構

*   `index.php`: 核心分流邏輯。
*   `config.php`: 系統配置與 Bot 關鍵字列表。
*   `white_page.html`: 廣告審核看到的「白頁」。
*   `landing_page.html`: 真實用戶看到的「黑頁」。
*   `access.log`: 自動生成的訪問日誌（需確保目錄有寫入權限）。

## 🛠️ 使用說明

1.  將所有檔案上傳至 PHP 伺服器環境。
2.  根據需求編輯 `config.php` 中的 `bot_keywords`。
3.  確保伺服器對專案目錄有寫入權限，以便生成 `access.log`。

---

## 聲明

本項目僅用於 **技術研究和學習用途**。

## ☁️ Vercel 部署指南

本專案已優化以支援 Vercel 部署。

### 部署步驟

1.  在 Vercel 中匯入此 GitHub 倉庫。
2.  在 **Environment Variables** 設定中新增：
    *   `REAL_LANDING_URL`: 設定為您想要真實用戶跳轉到的網址（例如 `https://your-real-site.com`）。
3.  點擊 **Deploy**。

### 工作原理

*   **審核員/Bot**: 會看到 `white_page.html` 的內容，URL 保持不變。
*   **真實用戶**: 
    *   如果設定了 `REAL_LANDING_URL`，會自動跳轉（302 Redirect）到該網址。
    *   如果未設定，則顯示 `landing_page.html`。
