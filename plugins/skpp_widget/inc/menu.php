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
        
        update_option( 'skpp_product_style', $_REQUEST['skpp_product_style']);
        echo get_option( 'skpp_product_style');
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

        <div class="skpp-style-settings postbox">
            <h3>Ustawienia stylów</h3>
            <p>Tutaj możesz określić jak będą wyglądały boxy z promowanymi produktami. Wybierz jeden z dwóch stylów lub
                zmień kolory. Wartość koloru powinna być podana w zapisie hexadecymalnym np. #ff0000.</p>
            <!--  table z opcjami stylow -->
            <table class="skpp-style-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="skpp_product_style">Styl produktów</label>
                        </th>
                        <td>
                            <fieldset>
                                <input type="radio" value="skpp_dvd" name="skpp_product_style"
                                    <?php if ('skpp_dvd' == get_option( 'skpp_product_style' )) { echo 'checked="checked"';} ?> />
                                <label for="skpp_dvd">DVD (płyta)</label>
                                <input type="radio" value="skpp_box" name="skpp_product_style"
                                    <?php if ('skpp_box' == get_option( 'skpp_product_style' )) { echo 'checked="checked"';} ?> />
                                <label for="skpp_box">BOX</label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="skpp_text_color">Kolor tekstu</label>
                        </th>
                        <td>
                            <input type="text" name="skpp_text_color"
                                value="<?php echo get_option('skpp_text_color'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="skpp_bg_color">Kolor tła</label>
                        </th>
                        <td>
                            <input type="text" name="skpp_bg_color" value="<?php echo get_option('skpp_bg_color'); ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <input type="hidden" name="action" value="save" />
        <input type="submit" class="button button-primary" value="Zapisz zmiany" />
    </form>



</div>


<?php
 }