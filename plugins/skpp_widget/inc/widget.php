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

        echo "Test widgetu SKPP";
        echo skpp_get_feed();

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