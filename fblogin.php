<?php
session_start();

require_once 'facebook/autoload.php'; 

$fb = new Facebook\Facebook([
  'app_id' => '1405262733404920',
  'app_secret' => 'c7c4a22a3df28f38ccb11c922db82eca',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
    $userData = $response->getGraphNode()->asArray();

    header("Location: output.php");
    exit();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

?>