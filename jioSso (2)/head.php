<?php $host = (stripos($_SERVER['REQUEST_SCHEME'],'https') === 0 ? 'https://' : 'http://').$_SERVER['HTTP_HOST'];$path = $host.$_SERVER['REQUEST_URI'];$cdn = "https://cdn.jsdelivr.net/gh/mohd-baquir-qureshi/Acrotv";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.4">
  <style type="text/css">
	body,html{height:100%;margin:0}.wrapper{height:100%;display:flex;flex-direction:column;text-align:center}.header{background:#00a1ff1c;border-bottom-style:solid;border-color:#000;}.footer{background:#1e90ff;border-top-style:solid;border-color:#000;color:#fff;font-weight:700;}.content{flex:1;overflow:auto;}a{text-decoration:none;}input{outline:0;border:1px solid #ccc;padding:10px;}input[type=search]{margin: 1% 0% 1% 0%;}input[type=submit]{background:#1e90ff;color:#fff;font-size:15px;}table{padding:20px;line-height: 40px;font-size:22px;width:100%;text-align:left;}a{color:purple;}
  </style>
  <link rel="icon" href="<?=$cdn;?>/favi.png" sizes="32x32">
  <title><?=$title;?></title>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <a href="<?=$host?>"><img src="<?=$cdn;?>/mlogo.png" width="306"></a>
    </div>
    <div class="content">
      <?php if($title!="AcroTV") echo '<form action="" method="POST"><input type="search" name="q" class="Search" placeholder="'.$searchPlaceholder.'" required><input type="submit"></form>';?>
      <table class="dataload" id="dataLoad">