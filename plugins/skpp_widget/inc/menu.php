<?php

function skpp_menu(){
    add_menu_page( 'Widget Programu Partnerskiego Strefa Kursów', 'SKPP Widget', 'manage_options', 'skpp_options', 'skpp_options', $icon_url = plugins_url( 'skpp_widget/images/skpp_icon.png' ) );
}

add_action('admin_menu', 'skpp_menu');

/**
 * Funkcja strony opcji
 */

 function skpp_options(){
     
    if(! current_user_can('manage_options')){

        wp_die(__('You do not have sufficient permissions to access this page'));

    }

    if('save' == $_REQUEST['action']){
        if(is_numeric( $_REQUEST['skpp_partner_id'] ) ){
            update_option('skpp_partner_id', $_REQUEST['skpp_partner_id']);
            ?>
<div class="notice updated">
    <p>Wszystkie zmiany zostały zapisane</p>
</div>
<?php
        }else{
            ?>
<div class="notice error">
    <p>Sprawdź czy na pewno podałeś właściwy ID Partnera (tylko cyfry)</p>
</div>
<?php
        }
       
    }


    ?>
<div class="skpp-options-wrapper">

    <form method="post" class="wrap skpp-options">
        <h2>Ustawienia wtyczki programu partnerskiego SK</h2>
        <div class="skpp-options-header postbox">
            <p>Tutaj możesz zmienić ustawienia wtyczki. Podaj swój identyfikator partnera, określ jakie produkty chcesz
                promować i zacznij zarabiać razem z nami! Więcej informacji na temat Programu Partnerskiego Strefy
                Kursów <a href="http://strefakursow.pl/program_partnerski.html">znajdziesz tutaj</a>.</p>

            <h3>Twój identyfikator partnera</h3>
            <input type="text" name="skpp_partner_id" value="<?php echo get_option("skpp_partner_id"); ?>" />
            <p>Swój identyfikator partnera możesz znaleźć po zalogowaniu do <a href="#">konta klienta w serwisie Strefa
                    Kursów.</a></p>
            <p><?php print_r(get_option("skpp_partner_id")); ?></p>
        </div>

        <input type="hidden" name="action" value="save" />
        <input type="submit" class="button button-primary" value="Zapisz zmiany" />
    </form>



</div>


<?php
 }