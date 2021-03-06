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

 /**
 * Pobiera jeden produkt;
 */

 function skpp_get_single_product(){
   $products = skpp_get_feed()->channel;
   $product = $products->item[skpp_select_random_product()];
   $product_name = $product->title;
   $product_link = $product->link;
   if ('skpp_box' == get_option( 'skpp_product_style') ){
      $product_image = $product->image_linkB; //styl box
      $product_features = $product->description;
      $product_revievs = $product->reviews;
   }else{
      $product_image = $product->image_linkA; //styl DVD
      $product_features = "";
      $product_revievs = "";
   };
   $product_price = $product->price;
   if(! empty($product->sale_price)){
      $product_sale_price = $product->sale_price;
   }else{
      $product_sale_price = '';
   }

   return array($product_name, $product_link, $product_image, $product_price, $product_features, $product_revievs, $product_sale_price);
 }


 /**
 * Pobiera jeden produkt z określonym ID;
 */

function skpp_get_product_by_id($id){
   $products = skpp_get_feed()->channel;
   $product_string = 'item[id="' . $id . '"]';
   $product = $products->xpath($product_string);
   $product = $product[0];
   // print_r($product);
   $product_name = $product->title;
   $product_link = $product->link;
   if ('skpp_box' == get_option( 'skpp_product_style') ){
      $product_image = $product->image_linkB; //styl box
      $product_features = $product->description;
      $product_revievs = $product->reviews;
   }else{
      $product_image = $product->image_linkA; //styl DVD
      $product_features = "";
      $product_revievs = "";
   };
   $product_price = $product->price;
   if(! empty($product->sale_price)){
      $product_sale_price = $product->sale_price;
   }else{
      $product_sale_price = '';
   }

   return array($product_name, $product_link, $product_image, $product_price, $product_features, $product_revievs, $product_sale_price);
 }



/**
 * Generuje link partnerski
 */

 function skpp_create_link($link){
   $link = $link . '?ref=' . get_option("skpp_partner_id");
   return $link;
 }


/**
 * Generuje opis produktu
 */

 function skpp_create_product_description($data){
   $features = explode(';', $data);
   $list = '';
   foreach($features as $feature){
      $list .= '<li>' .  $feature . '</li>';
   }
   return $list;
 }


 /**
 * Zwaraca obcietą cene
 */

 function skpp_trim_price($price){
    $trim_price = str_replace(".00", "", $price);
    return $trim_price;
 }