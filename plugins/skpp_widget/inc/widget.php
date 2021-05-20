<?php

/**
 * Klasa widgetu
 */

class Skpp_Widget extends WP_Widget{
    /* Konstruktor */

    function __construct(){
        parent::__construct(
            'skpp_widget',
            'Widget SKPP',
            array(
                'description' => 'Wyświetla jeden produkt'
            )
        );
    }

    /*Główna funkcja */

    function widget($args, $instance){
        /* przed widgetem */
        echo $args['before_widget'];
        
        $title = apply_filters( 'widget_title', $instance['title'] );

        if($instance['title']){
            echo $args['before_title'] . $title . $args['after_title'];
        }

       $product = skpp_get_single_product();

       echo '<div class="skpp-single-prod">';
            echo '<a rel="nofollow" href="' . skpp_create_link($product[1]) . '">';
                echo '<span class="product_image">';
                    echo ' <span class="product-image-overlay"></span>';
                    echo '<img src="' . $product[2] . '" alt="' . $product[0] . '" />';
                echo '</span> ';
                echo '<span class="product-inner">';
                    echo '<h3>' . $product[0] . '</h3>';
                    echo '<ul>';
                        echo skpp_create_product_description($product[4]);
					echo '</ul>';
                    echo '<span class="product-bottom-row">';
                        echo '<span class="skpp-price">' . skpp_trim_price($product[3]) . '</span>';
                        echo '<span class="skpp-sale-price"><del>' . $product[6] . '</del></span>';
                        echo '<span class="skpp-opinion">';
                            echo '<span class="skpp-stars"></span>';
                            echo '<span class="skpp-reviews">' . $product[5] . '</span>';
                        echo '</span>';
                    echo '</span>';
                echo '</span>';
            echo '</a>';
       echo '</div>';


        echo $args['after_widget'];
            
    }

    /* Formularz opcji widgetu*/ 
    function form($instance){
        $defaults = array(
            'title' =>  'Polecany Kurs',
        );
        $instance = wp_parse_args((array) $instance, $defaults);

        ?>
<!--Tytuł widgetu -->
<p>
    <label for="title">Tytuł</label>
    <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
</p>

<?php
        
    }

    /*aktualizacja instancji widgetu*/
    
    function update($new_instance, $old_instance){ 
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    


}

/**
 * Rejstrujemy widget
 */

 function skpp_load_widget(){
    register_widget('skpp_widget');
 }

 add_action('widgets_init', 'skpp_load_widget');