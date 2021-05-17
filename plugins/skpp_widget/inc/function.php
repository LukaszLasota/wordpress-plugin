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
   //  print_r($xml);
    return $xml;
 }

 /**
 * Zliczanie produktów
 */

 function skkp_count_products(){
    $products = skpp_get_feed()->channel;
    $count = $products->children()->count()-2;
    return $count;
 }


/**
 * Wybieranie losowej wartości;
 */

 function skpp_select_random_product(){
   $rand = rand(0, skkp_count_products());
   return $rand;
 }