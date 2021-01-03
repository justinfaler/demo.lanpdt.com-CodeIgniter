<html>
<head>
  <title>Your Website Title</title>
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
  <meta property="og:url"           content="https://ci.metizcloud.com/cpa2go/About_us" />
  <meta property="og:type"          content="cpa2go" />
  <meta property="og:title"         content="cpa2go" />
  <meta property="og:description"   content="cpa2go description" />
  <meta property="og:image"         content="https://ci.metizcloud.com/cpa2go/assets/front/cpa/image/main_logo.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

  <!-- Load Facebook SDK for JavaScript -->
  <!-- <div id="fb-root"></div> -->
  <script>

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  
  
</script>

  <!-- Your share button code -->
  <div class="fb-share-button" 
    data-href="https://ci.metizcloud.com/cpa2go/About_us" 
    data-layout="button_count">
  </div>

  <?php
    $title=urlencode('CPA2GO');
    $url=urlencode('https://ci.metizcloud.com/cpa2go/About_us');
    $image=urlencode('https://ci.metizcloud.com/cpa2go/assets/front/cpa/image/main_logo.png');
  ?>

  

  <a href="http://twitter.com/share?text=<?=$title?>&url=<?=$url?>" class="twitter-share-button" data-show-count="false">Tweet</a>
  <!-- <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$url?>&title=<?=$title?>" class="twitter-share-button" data-show-count="false">Link</a> -->
  <a href="https://www.linkedin.com/shareArticle?mini=true&url=[<?=$url?>]&title=[<?=$title?>]" class="twitter-share-button" data-show-count="false">Link</a>
  <a href="https://www.instagram.com/?url=https://ci.metizcloud.com/cpa2go/About_us" target="_blank" rel="noopener">
    Share on instagram
</a>

</body>
</html>

<style type="text/css">
  .btn_des{
    border-radius: 100% !important;
  }
</style>




