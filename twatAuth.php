<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    define('CONSUMER_KEY', 'YOUR CONSUMER KEY');
    define('CONSUMER_SECRET', 'YOUR CONSUMER SECRET');
    define('OAUTH_TOKEN', 'YOUR OAUTH TOKEN');
    define('OAUTH_SECRET', 'YOUR OAUTH SECRET');

    $oauth_hash = '';
    $oauth_hash .= 'oauth_consumer_key=' . CONSUMER_KEY . '&';
    $oauth_hash .= 'oauth_nonce=' . md5(time()) . '&';
    $oauth_hash .= 'oauth_signature_method=HMAC-SHA1&';
    $oauth_hash .= 'oauth_timestamp=' . time() . '&';
    $oauth_hash .= 'oauth_token=' . OAUTH_TOKEN . '&';
    $oauth_hash .= 'oauth_version=1.0';

    $base = '';
    $base .= 'GET';
    $base .= '&';
    $base .= rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json');
    $base .= '&';
    $base .= rawurlencode($oauth_hash);

    $key = '';
    $key .= rawurlencode(CONSUMER_SECRET);
    $key .= '&';
    $key .= rawurlencode(OAUTH_SECRET);

    $signature = base64_encode(hash_hmac('sha1', $base, $key, true));
    $signature = rawurlencode($signature);

    $oauth_header = '';
    $oauth_header .= 'oauth_consumer_key="' . CONSUMER_KEY . '", ';
    $oauth_header .= 'oauth_nonce="' . md5(time()) . '", ';
    $oauth_header .= 'oauth_signature="' . $signature . '", ';
    $oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
    $oauth_header .= 'oauth_timestamp="' . time() . '", ';
    $oauth_header .= 'oauth_token="' . OAUTH_TOKEN . '", ';
    $oauth_header .= 'oauth_version="1.0", ';

    $curl_header = array("Authorization: Oauth {$oauth_header}");
    $curl_request = curl_init();

    curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
    curl_setopt($curl_request, CURLOPT_HEADER, false);
    curl_setopt($curl_request, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/user_timeline.json');
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);

    $json = curl_exec($curl_request);
    curl_close($curl_request);

    die($json);

} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die;
}
