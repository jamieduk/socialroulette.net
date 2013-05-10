<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
require 'facebooksdk/src/facebook.php';
require 'cfg.php';

//Get Path
$path = explode('/',str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']));
array_shift($path);

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => Config::appId,
  'secret' => Config::secret,
));

// Get User ID
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

$loginUrl = $facebook->getLoginUrl(array('scope' => 'publish_stream, email, rsvp_event, publish_actions, friends_online_presence, user_online_presence, manage_notifications, manage_friendlists, create_event, ads_management, xmpp_login, read_stream, read_requests, read_mailbox, read_insights, read_friendlists, user_work_history, user_website, user_videos, user_subscriptions, user_status, user_religion_politics, user_relationship_details, user_relationships, user_questions, user_photos, user_notes, user_location, user_likes, user_interests, user_hometown, user_groups, user_education_history, user_games_activity, user_actions.video, user_actions.news, user_actions.music')); 

?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Social Roulette</title>
    <meta name="description" content="Social Roulette has a 1/6 chance of deleting your account, 5/6 chance that it just posts 'you played' to your timeline.">
    
    <meta http-equiv="Content-Type" content="text/html;">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
  <style type="text/css">
    #play {background: red;}
  #roulette {
    width: 400px;
    height: 400px;
    margin:0 auto;
    top:100px;
    position:relative;
    
          
  }
  #rouletteBackground{
    position:absolute;
    background-image: url("animation/roul1.png"); 
    background-size:400px;
    width: 400px;
    height: 400px;
  }
  #rouletteRotater{
    position:absolute;
    background-image: url("animation/roul2.png"); 
    background-size:400px;
    width: 400px;
    height: 400px;
  }
  #rouletteCrosshair{
    position:absolute;
    background-image: url("animation/crosshgair.png"); 
    background-size:400px;
    width: 400px;
    height: 400px;
  }    
  </style>  
</head>
  <body>
  <div class="navbar navbar-inverse navbar-roulette">
      <div class="navbar-inner">
          <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </a>
              <a class="brand" href="http://socialroulette.com/">
                <strong>Social Roulette</strong>
              </a>
              <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                      <li><a href="http://twitter.com/roulettenet"><img src="./img/twitterIcon.png" class="twitterIcon">Twitter</a></li>
                      <li><a href="mailto:info@socialroulette.com"><img src="./img/mailIcon.png" class="contactIcon">Contact</a></li>
                </ul>
            </div>
          </div>
        </div>
    </div>
    <div style="padding-top: 30px; padding-bottom: 20px; text-align: center;" class="roulette-title-background row-fluid">
    <div class="span4 rouletteQuoteSpan" id="appQuote"><img src="./img/quote.png" class="rouletteQuote" width="256" height="169"></div>
    
    <!-- <div class="span4" id="appIcon"><img src="./img/256.png" width="256" height="256"></div> -->
    
    <div id="roulette" class="span4" id="appIcon">
      <div id="rouletteBackground"></div>
      <div id="rouletteRotater"></div>
      <div id="rouletteCrosshair"></div>
      
    </div>

    <div class="span4" id="downloadArea" style="margin-left:0px; margin-top: 90px;">
      <?php if($user): ?>
        <a class="btn btn-large btn-primary" id="play" href="">Play Social Roulette</a>
      <?php else: ?>
        <a class="btn btn-large btn-primary" href="<?php echo $loginUrl?>">Login to Play Social Roulette</a>
      <?php endif;?>
      
    </div>
    <div style="clear: both;text-shadow: 0px 1px 1px #91999d; color:black; font-size:30px; padding: 15px 55px 0px 55px; line-height: 50px">Social Roulette has a 1 in 6 chance of deleting your account.<br/>What are you afraid of?</div></div>
    <!--<div class="center"><input type="submit" value="Play Presentation Video" class="rouletteButton playButton"></div>-->
    <div class="container center">
    <div class="dlead dmargintop dmarginbottom">The Story</div>
    <div class="justify maintext">Social Roulette has a 1 in 6 chance of deleting your account, and a 5 in 6 chance that it just posts "You played Social Roulette" to your timeline.
    </div>
    
    <div class="dlead dmargintop dmarginbottom">Testimonials</div>
    <div class="justify maintext">Social Roulette just rewrote the rules for online gaming.</div>
    <div class="justify maintext">Playing Social Roulette is the most exciting thing I've done this year.</div>
    <div class="justify maintext">I still can't tell whether I won or not.</div>
    
    <hr class="roulette">
    
    <div class="dlead dmarginbottom">Rules</div>
    <div class="justify maintext"><p></p></div>
    <div class="justify maintext"><p>
    <ol>
    <li>You must play with your <span class="highlighted">own account</span>.</li>
    <li>You may only play <span class="highlighted">once a day</span>.</li>
    </ol>
    </p></div>
    
    <div class="myFooter"></div>      
  </div>
  <script src="javascript/jquery.min.js"></script>
  <script src="javascript/bootstrap.min.js"></script>
  <script src="javascript/theme.js"></script>

  <script>
    var returnMess = "";
    var tickSnd = new Audio("animation/tick.wav"); // buffers automatically when created
    tickSnd.addEventListener('ended', function() {
        this.currentTime = 0;
//        this.play();
    }, false);
    
    var rotation = 0;
    var speed = 20;
    var ticks = 0;
    var force = 0;
    
    var finished = false;
    
    function finish(){
      finished = true;
      
      if(ticks <= 4){
        console.log("looser");
      } else {
        console.log("WINNER");
      }
      
      $("#result").html(returnMess);

    }
    
    function update(){
      if(!finished){
        force += speed;
      
        if(speed < 2 && (tickValue > ticks || (ticks == 5 && tickValue < 5))) {
          finish();
          return;
        };
      
          rotation += force;
          rotation = rotation % 360;
      
          tickValue = Math.floor((rotation/360)*6);
          if(tickValue > ticks || (ticks == 5 && tickValue < 5)){       
            //f = rotation - ticks * 1/6 * 360;
            rotation -= force;
            rotation = rotation % 360;

            if(force > 10){
              force = speed*1.5;
              ticks++;
              ticks = ticks%6;
              if(tickSnd.currentTime == 0 ){
  //              tickSnd.load();
                tickSnd.play();
              }
           }  
        } else {
          force = 0;
        }
      
      
        speed *= 0.997;
        rotate(rotation);
        //console.log(speed)
      }
//        setTimeout(update, 100);
      
    }

    
    $("#play").click(function() {      
      //do animation stuff here      

      $.ajax({
        url: "/play.php",
        success: function(data) {          
          if(data === "503") {

            window.location.href = "http://socialroulette.net/";
          
          } else {            
            var loop = setInterval(function(){update()},30);
            rotation =   Math.random() * (3*360/6 - (-2*360/6)) + (-2*360/6); 
            returnMess = data;          
          }
        }
      });

      return false;
    });
  </script>

  <script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview'],['_trackPageLoadTime']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>  

</body>
</html>