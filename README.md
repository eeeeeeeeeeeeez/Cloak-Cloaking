
# 广告斗篷系统（Cloak System）- 流量过滤与广告过审技术

一个用于 **广告流量识别与访问分流的斗篷系统示例项目**。

该项目演示如何通过 **黑白页分离技术 + 访问环境识别**，实现广告审核访问与真实用户访问的内容分离。

适合研究：

- 广告斗篷系统
- Cloaking技术
- 流量过滤
- Bot识别
- 落地页保护

---

# 什么是斗篷系统

斗篷系统（Cloak / Cloaking）是一种 **访问识别与内容分流技术**。

系统会根据访问者环境进行判断，例如：

- IP地址
- 浏览器UserAgent
- 访问来源
- 设备类型
- 是否为机器人
- 是否为广告审核蜘蛛

然后根据访问身份 **返回不同页面内容**。

示例：

|访问者|返回页面|
|---|---|
|广告审核蜘蛛|白页|
|搜索引擎爬虫|白页|
|真实用户|黑页|

这样可以实现：

- 广告审核访问和真实用户访问完全分离
- 广告投放更稳定
- 防止落地页被扫描

---

# 黑白页分离技术

斗篷系统通常采用 **黑白页分离结构**。

白页（White Page）

- 用于广告审核
- 内容安全合规
- 提供给审核系统访问

黑页（Landing Page）

- 真实用户访问页面
- 用于广告转化
- 不被审核系统看到

整个访问过程 **URL地址保持不变**。

---

# 核心功能

本示例项目包含基础斗篷逻辑：

- 黑白页分离
- Bot识别
- UserAgent检测
- IP访问控制
- 地区访问控制
- PC / 手机访问控制
- 流量分流

---

# 示例代码

```php
<?php

function detectBot(){

$bots = [
"googlebot",
"bingbot",
"facebookexternalhit",
"crawler",
"spider",
"bot"
];

$userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');

foreach($bots as $bot){

if(strpos($userAgent,$bot) !== false){

return true;

}

}

return false;

}

if(detectBot()){

include "white_page.html";

}else{

include "landing_page.html";

}

?>
```

---

# 使用场景

斗篷系统常用于：

- 广告流量过滤
- 落地页保护
- 防止机器人访问
- 防止爬虫扫描
- 广告投放流量控制

---

# 相关关键词

斗篷系统  
广告斗篷  
Cloak系统  
Cloaking技术  
广告过审技术  
流量过滤系统  
Bot识别  
广告安全系统  

---

# 无相盾广告流量安全系统

如果你需要完整系统，可以访问：

https://wuxiangdun.com/

无相盾提供：

- 智能流量过滤
- Bot识别系统
- 广告流量安全引擎
- 域名安全防护
- 像素回传系统

---

# 声明

本项目仅用于 **技术研究和学习用途**。
