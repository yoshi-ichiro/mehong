<?php

$fp = fopen('proxy','w');
$json = file_get_contents('https://www.proxydocker.com/en/proxylist/api?email=heaths%40ehmemail.com&country=all&city=all&port=all&type=http-https&anonymity=ELITE&state=all&need=all&format=json');

$pr = json_decode($json)->Proxies;
$c = count($pr);
$select = $pr[0];

fwrite($fp, $select->ip.':'.$select->port)

?>