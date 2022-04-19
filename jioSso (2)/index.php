<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
require 'functions.php';
$title = "JioTv";
$searchPlaceholder = "Search";
if(!isset($_GET['hdKey']) && !isset($_GET['key']) && !isset($_GET['pid']) && !isset($_GET['id']) && !isset($_GET['ch']) && !isset($_GET['lice']) && !isset($_GET['caId']) && !isset($_GET['catchupPid']))
  require 'head.php';
if(!isset($_GET['hdKey']) && !isset($_GET['pid']) && !isset($_GET['id']) && !isset($_GET['key']) && !isset($_GET['ch']) && !isset($_GET['lice']) && !isset($_GET['ca']) && !isset($_GET['caId']) && !isset($_GET['catchupPid'])){
  $list = json_decode(file_get_contents("jioChannels.json",true),true);
  echo "<h2><a href='/playlist.php' download='playlist.m3u8'>Download Playlist</a></h2>";
  for($i=0;$i<count($list);$i++){
    echo "<tr><td><a href='$path".$list[$i][0]."' target='_blank'>".$list[$i][1]."</a> ";
    if($list[$i][2]!=""){
      $licenseData = $list[$i][2];
      $licenseData = explode("@",$licenseData);
      $licenseId = $licenseData[1];
      echo "| <a href='$path"."FHD/".$list[$i][3]."/$licenseId' target='_blank'>Full HD</a> ";
      if($list[$i][4])
        echo "| <a href='$path"."Catchup/".$list[$i][0]."/0' target='_blank'>Catchup</a></td></tr>";
      else
        echo "</td></tr>";
    }
    else{
      if($list[$i][4])
        echo "| <a href='$path"."Catchup/".$list[$i][0]."/0' target='_blank'>Catchup</a></td></tr>";
      else
        echo "</td></tr>";
    }
  }
}
else if(isset($_GET['pid'])){
  $id = $_GET['pid'];
  list($header, $body) = initCurlRequest("GET", "http://sbhplecdnems10.cdnsrv.jio.com/jiotv.data.cdn.jio.com/apis/v1.3/getepg/get?offset=0&channel_id=$id", "", array('Accept-Encoding: gzip'));
  $channelInfo = json_decode(gzdecode($body),true);
  $name = $channelInfo['channel_name'];
  $link = $id.".m3u8";
  require 'jwdrm.php';
  die();
}
else if(isset($_GET['id'])){
  header("Content-Type: application/vnd.apple.mpegurl");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Expose-Headers: Content-Length,Content-Range");
  header("Access-Control-Allow-Headers: Range");
  header("Accept-Ranges: bytes");
  $id = $_GET['id'];
  if(strstr($id,"~")){
    $pkgData = parse_url($path);
    parse_str($pkgData['query'], $params);
    $pkg = $params['pkg'];
    $id = explode("~",$id);
    $html = jiotv("GET","http://sbhplecdnems06.cdnsrv.jio.com/jiotv.live.cdn.jio.com/$pkg/".$id[0]."/".$id[1].".m3u8","");
    $html = preg_replace("/" . $id[1] . "-([^.]+\.)ts/", "https://sbhplecdnems06.cdnsrv.jio.com/jiotv.live.cdn.jio.com/$pkg/".$id[0]."/" . $id[1] . '-\1ts', $html);
    $html = preg_replace("/" . $id[1] . "_([^.]+\.)ts/", "https://sbhplecdnems06.cdnsrv.jio.com/jiotv.live.cdn.jio.com/$pkg/".$id[0]."/" . $id[1] . '_\1ts', $html);
    $html = str_replace("https://tv.media.jio.com/","/?key&url=https://tv.media.jio.com/",$html);
    echo $html;
    die();
  }
  else if(strstr($id,"_")){
    $idd = str_replace(['_250', '_400', '_600', '_800'], '', $id);
    $html = jiotv("GET","http://sbhplecdnems06.cdnsrv.jio.com/jiotv.live.cdn.jio.com/".$idd."/".$id.".m3u8","");
    $html = preg_replace("/" . $id . "-([^.]+\.)ts/", "https://sbhplecdnems06.cdnsrv.jio.com/jiotv.live.cdn.jio.com/".$idd."/" . $id . '-\1ts', $html);
    $html = preg_replace("/" . $id . "_([^.]+\.)ts/", "https://sbhplecdnems06.cdnsrv.jio.com/jiotv.live.cdn.jio.com/".$idd."/" . $id . '_\1ts', $html);
    $html = str_replace("https://tv.media.jio.com/","/?key&url=https://tv.media.jio.com/",$html);
    echo $html;
    die();
  }
  $channelData = json_decode(jiotv("POST","https://tv.media.jio.com/apis/v1.4/getchannelurl/getchannelurl?langId=6&userLanguages=1%2C6",'{"channelId":'.$id.',"channel_id":'.$id.',"programId":"201122833009","showtime":null,"srno":"20201122","stream_type":"Seek"}'),true);
  $channelUrl = $channelData['result'];
  $channelUrl = str_replace(["http://","https://"],"",$channelUrl);
  $channelUrl = "http://sbhplecdnems06.cdnsrv.jio.com/".$channelUrl;
  $m3u8Data = jiotv("GET",$channelUrl,"");
  $channelUrl = explode("/",$channelUrl);
  $channelId = $channelUrl[5];
  $pkg = $channelUrl[4];
  $m3u8Data = str_replace("1.m3u8","$channelId~1.m3u8?pkg=$pkg",$m3u8Data);
  $m3u8Data = str_replace("2.m3u8","$channelId~2.m3u8?pkg=$pkg",$m3u8Data);
  $m3u8Data = str_replace("3.m3u8","$channelId~3.m3u8?pkg=$pkg",$m3u8Data);
  $m3u8Data = str_replace("4.m3u8","$channelId~4.m3u8?pkg=$pkg",$m3u8Data);
  echo $m3u8Data;
}
else if(isset($_GET['catchupPid'])){
  header("Content-Type: application/vnd.apple.mpegurl");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Expose-Headers: Content-Length,Content-Range");
  header("Access-Control-Allow-Headers: Range");
  header("Accept-Ranges: bytes");
  $catchupId = $_GET['catchupPid'];
  if(strstr($catchupId,"index")){
    $id = explode("|",$catchupId);
    $ids = explode("_",$id[0]);
    $file = $id[1];
    $cid = $ids[0];
    $showtime = $ids[1];
    $pid = $ids[2];
    $serverTime = $ids[3];
    $channelData = json_decode(jiotv("POST","https://tv.media.jio.com/apis/v1.4/getchannelurl/getchannelurl?langId=6&userLanguages=1%2C6",'{"channelId":'.$cid.',"channel_id":'.$cid.',"programId":"'.$pid.'","showtime":"'.$showtime.'","srno":"'.$serverTime.'","stream_type":"Catchup"}'),true);
    $link = $channelData['result'];
    $baseLink = str_replace("master.m3u8","",$link);
    $m3u8Data = jiotv("GET",$baseLink.$file.".m3u8","");
    $m3u8Data = str_replace("https://tv.media.jio.com/","/?key&url=https://tv.media.jio.com/",$m3u8Data);
    $m3u8Data = str_replace("seg","$baseLink"."seg",$m3u8Data);
    echo $m3u8Data;
    die();
  }
  $id = explode("_",$catchupId);
  $cid = $id[0];
  $showtime = $id[1];
  $pid = $id[2];
  $serverTime = $id[3];
  $channelData = json_decode(jiotv("POST","https://tv.media.jio.com/apis/v1.4/getchannelurl/getchannelurl?langId=6&userLanguages=1%2C6",'{"channelId":'.$cid.',"channel_id":'.$cid.',"programId":"'.$pid.'","showtime":"'.$showtime.'","srno":"'.$serverTime.'","stream_type":"Catchup"}'),true);
  $link = $channelData['result'];
  $m3u8Data = jiotv("GET",$link,"");
  $m3u8Data = str_replace("index",$catchupId."|index",$m3u8Data);
  echo $m3u8Data;
}
else if(isset($_GET['key']))  
  echo jiotv("GET",$_GET['url'],"");
else if(isset($_GET['hdKey']))
  echo jiotvKey("POST",$_GET['url']."&content_id=".$_GET['content_id'],file_get_contents('php://input'));
else if(isset($_GET['ch'])){
  $name = "Full HD Channel";
  $link = "https://sbhplecdnems02.cdnsrv.jio.com/jiotv.live.cdn.jio.com/bpk-tv/".$_GET['ch']."_BTS/output/index.mpd?".jiotvJct();
  $lice = "/?hdKey&url=https://tv.media.jio.com/proxy?provider=reliance&content_id=".$_GET['lice'];
  require 'jwdrm.php';
}
else if(isset($_GET['ca'])){
  $id = $_GET['ca'];
  $pg = $_GET['pg'];
  list($header, $body) = initCurlRequest("GET", "http://sbhplecdnems10.cdnsrv.jio.com/jiotv.data.cdn.jio.com/apis/v1.3/getepg/get?offset=$pg&channel_id=$id", "", array('Accept-Encoding: gzip'));
  $catchupDataArr = json_decode(gzdecode($body),true);
  for($i=0;$i<count($catchupDataArr['epg']);$i++){
    $showtime = $catchupDataArr['epg'][$i]['showtime'];
    $epiShowTime = str_replace(":","",$showtime);
    $name = $catchupDataArr['epg'][$i]['showname']." (".$showtime." - ".$catchupDataArr['epg'][$i]['endtime'].")";
    echo "<tr><td><a href='$epiShowTime/".$catchupDataArr['epg'][$i]['srno']."' target='_blank'>$name</a></td></tr>";
  }
}
else if(isset($_GET['caId'])){
  $id = $_GET['caId'];
  $showtime = $_GET['showtime'];
  $pid = $_GET['srno'];
  $srno = date("Y").date("m").date("d");
  $link = "$host/PlayCatchup/".$id."_".$showtime."_".$pid."_".$srno.".m3u8";
  $name = "Jiotv Catchup";
  require 'jwdrm.php';
  die();
}
if(!isset($_GET['hdKey']) && !isset($_GET['key']) && !isset($_GET['pid']) && !isset($_GET['id']) && !isset($_GET['ch']) && !isset($_GET['lice']) && !isset($_GET['caId']) && !isset($_GET['catchupPid']))
  require 'foot.php';
?>
