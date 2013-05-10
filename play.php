<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

require 'facebooksdk/src/facebook.php';
require 'dbcfg.php';

$facebook = new Facebook(array(
  'appId'  => '283583331777209',
  'secret' => 'c2f8f3549e44fc5a51c027694c090871',
));

  
$user = $facebook->getUser();

if ($user) {
  $message = "Phew, You Survived Social Roulette!";

  //check user count
  $stmt = DB::prepare("SELECT * FROM users WHERE user=?");
  $stmt->execute(array($user));
  if($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $count = $row["count"];
  } else {
    $count = 0;
  }

  //add cordinal message to status update
  if($count > 0) {
    $ext = "for the " . addOrdinalNumberSuffix($count) . " time";
  } else {
    $ext = "";
  }

  //try to post, will get rejected if it's a dubplicate
  try {    

    $facebook->api('/me/feed', 'post', array('message'=> "I just survived Social Roulette ".$ext."! – http://socialroulette.net"));
    
    //insert || update DB with count & userid
    if($count > 0 ) {
      $stmt = DB::prepare("UPDATE users SET count = ? WHERE user = ?");
      $stmt->execute(array($count+1, $user));
    
    } else {
      $stmt = DB::prepare("INSERT INTO users SET count=1, user = ?");
      $stmt->execute(array($user));
    }

    //return message
    echo "<h1>Phew, You Survived Social Roulette ".$ext."!</h1><a href='/play'>Click Here To Play Again!</a>";

  } catch (FacebookApiException $e) {
    error_log($e);
    echo "<h1>You Can Only Play Once A Day... :/</h1>";
  }

} else {
  echo "503";
}


function addOrdinalNumberSuffix($num) {
  if (!in_array(($num % 100),array(11,12,13))){
    switch ($num % 10) {
      // Handle 1st, 2nd, 3rd
      case 1:  return $num.'st';
      case 2:  return $num.'nd';
      case 3:  return $num.'rd';
    }
  }
  return $num.'th';
}