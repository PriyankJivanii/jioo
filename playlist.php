<?php

header("Content-Type: application/vnd.apple.mpegurl");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length,Content-Range");
header("Access-Control-Allow-Headers: Range");
header("Accept-Ranges: bytes");
$list = json_decode(file_get_contents("jioChannels.json",true),true);
$host = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://".$_SERVER['HTTP_HOST'];
echo "#EXTM3U\n";
for($i=0;$i<count($list);$i++)
    echo '#EXTINF:1 tvg-logo="'.$list[$i][5].'" ,'.$list[$i][1]."\n"
    .$host.'/'.$list[$i][0].".m3u8\n";

?>