<?php
$host = (stripos($_SERVER['REQUEST_SCHEME'],'https') === 0 ? 'https://' : 'http://').$_SERVER['HTTP_HOST'];
$path = $host.$_SERVER['REQUEST_URI'];
$cdn = "https://cdn.jsdelivr.net/gh/mohd-baquir-qureshi/Acrotv";
function initCurlRequest($reqType, $reqURL, $reqBody = '', $headers = array()){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $reqURL);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $reqType);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $reqBody);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_HEADER, true);
  $body = curl_exec($ch);
  $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $header = substr($body, 0, $headerSize);
  $header = getHeaders($header);
  $body = substr($body, $headerSize);
  curl_close($ch);
  return [$header, $body];
}
function getHeaders($respHeaders){
  $headers = array();
  $headerText = substr($respHeaders, 0, strpos($respHeaders, "\r\n\r\n"));
  foreach (explode("\r\n", $headerText) as $i => $line) {
    if ($i === 0)
      $headers['http_code'] = $line;
    else {
      list ($key, $value) = explode(': ', $line);
      if($key=="Set-Cookie")
        $headers[$key][] = $value;
      else
        $headers[$key] = $value;
    }
  }
  return $headers;
}
$jctBase = "cutibeau2ic";
$ssoToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmlxdWUiOiI0MDgyOTljMi03OGY1LTQzNzctOGM2OC02ODY4MWQ2NjViZmEiLCJ1c2VyVHlwZSI6IlJJTHBlcnNvbiIsImF1dGhMZXZlbCI6IjEwIiwiZGV2aWNlSWQiOm51bGwsImp0aSI6ImQ4ZTBhNjJjLWM1MzUtNDg5Ny05YTg3LTg2NjE0NDg0NjkxMCIsImlhdCI6MTYxNDE4NjEyMn0.n6TyQ1colAqWyex3-VqJNxclV2F1hiRGAByGpTFYxWM";
function tokformat($str){
  $str= base64_encode(md5($str,true));
  return str_replace("\n","",str_replace("\r","",str_replace("/","_",str_replace("+","-",str_replace("=","",$str)))));
}
function generateJct($st, $pxe) {
  global $jctBase;
  return trim(tokformat($jctBase . $st . $pxe));
}
function generatePxe() {
  return time() + 6000;
}
function generateSt() {
  global $ssoToken;
  return tokformat($ssoToken);
}
function jiotvJct() {
  $st = generateSt();
  $pxe = generatePxe();
  $jct = generateJct($st, $pxe);
  return "jct=" . $jct . "&pxe=" . $pxe . "&st=" . $st;
}
function jiotv($reqType,$reqURL,$reqBody){
  $sessionData = json_decode(file_get_contents("jioSso.json",true),true);
  $sso = $sessionData['ssoToken'];
  $subId = $sessionData['sessionAttributes']['user']['subscriberId'];
  $uniqueId = $sessionData['sessionAttributes']['user']['unique'];
  list($header, $body) = initCurlRequest($reqType, $reqURL."?".jiotvJct(), $reqBody, array('User-Agent: plaYtv/6.0.5 (Linux;Android 5.1.1) ExoPlayerLib/2.10.6','Content-Length: '.strlen($reqBody),'Content-Type: application/json; charset=UTF-8','appkey: NzNiMDhlYzQyNjJm','channelid: 816','camid: ','channel_id: ','crmid: '.$subId,'deviceId: 8c2e430a69d52064','devicetype: phone','isott: false','langid: ','languageId: 6','lbcookie: 1','os: android','osVersion: 5.1.1','ssotoken: '.$sso,'subscriberId: '.$subId,'uniqueId: '.$uniqueId,'usergroup: tvYR7NSNn7rymo3F','userId: '.$subId,'versionCode: 250','srno: 202020202020'));
  return $body;
}
function jiotvKey($reqType,$reqURL,$reqBody){
  $sessionData = json_decode(file_get_contents("jioSso.json",true),true);
  $sso = $sessionData['ssoToken'];
  $subId = $sessionData['sessionAttributes']['user']['subscriberId'];
  $uniqueId = $sessionData['sessionAttributes']['user']['unique'];
  list($header, $body) = initCurlRequest($reqType, $reqURL."&".jiotvJct(), $reqBody, array('User-Agent: plaYtv/5.8.1 (Linux;Android 5.1) ExoPlayerLib/2.8.0','Content-Length: '.strlen($reqBody),'appkey: NzNiMDhlYzQyNjJm','channelid: 167','crmid: '.$subId,'deviceId: mmmbbbccczzzdddf','devicetype: phone','lbcookie: 1','os: android','osVersion: 5.1','srno: 2001131160006','ssotoken: '.$sso,'subscriberId: '.$subId,'uniqueId: '.$uniqueId,'usergroup: tvYR7NSNn7rymo3F','userId: '.$subId,'versionCode: 250'));
  return $body;
}
?>