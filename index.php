
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
