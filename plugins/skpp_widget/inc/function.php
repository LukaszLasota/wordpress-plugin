<?php 
/**
 * Pobiera dane z XML
 */

 function skpp_get_feed(){
    $feed_url = plugins_url('/skpp_widget/feed_strefakursow.xml');
    $cu = curl_init($feed_url);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    $xml = curl_exec($cu);
    curl_close($cu);
    $xml = simplexml_load_string($xml);
    print_r($xml);
    return $xml;
 }