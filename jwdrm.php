<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="theme-color" content="black">
  <title><?=$name?></title>
  <style>*{margin:0;padding:0;outline:none;}*:focus{outline:none;}#jwplayer{position: absolute;width:100% !important;height:100% !important;}</style>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/jwplayer/web-player-demos/demos/custom-css-demo/assets/alaska.css'>
</head>
<body>
  <script src="https://content.jwplatform.com/libraries/KB5zFt7A.js"></script>
  <script type="text/javascript">       
    window.onload=function(){
      const playerInstance = jwplayer("jwplayer").setup({
        image: "https://akamaividz2.zee5.com/image/upload/w_1337,h_536,c_scale,f_webp,q_auto:eco/resources/0-101-externalli_443308300/cover/1170x658withlog_1948036612.jpg",
        title: "<?=$name?>",
        description: "Powered by Acrotv",
        skin: {name: "alaska"},
        fullscreen: "true",
        autostart: false,
        controls: true,
        preload: "auto",
        playbackRateControls: [0.25, 0.5, 0.75, 1, 1.25, 1.5, 2],
        abouttext: "About Developer",
        aboutlink: "https://github.com/mohd-baquir-qureshi",
        "file":"<?=$link?>",
        tracks: [{ 
          "file": "<?=$sub?>", 
          "label": "English",
          "kind": "captions"
        }],
        <?php if(strpos($link,'mpd') == true) { ?>
        "type":"mpd",
        "drm": {
          "widevine": {"url": "<?=$lice?>"}
        }
        <?php } if(strpos($link,'m3u8') == true) { ?>
        "type":"mp4"
        <?php } ?>
      });
      playerInstance.on('ready', function() {
        const playerContainer = playerInstance.getContainer();
        const buttonContainer = playerContainer.querySelector('.jw-button-container');
        const spacer = buttonContainer.querySelector('.jw-spacer');
        const timeSlider = playerContainer.querySelector('.jw-slider-time');
        buttonContainer.replaceChild(timeSlider, spacer);
      });
    }
  </script>       
  <div id="jwplayer"></div>
</body>
</html>