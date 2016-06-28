<?php
class FDL_Builder_Module_Clickable_Blurb extends ET_Builder_Module {
   function init() {
      $this->name = __( 'Clickable Blurb', 'et_builder' );
      $this->slug = 'et_pb_blurb2';
      $this->main_css_element = '%%order_class%%.et_pb_blurb';

      $this->whitelisted_fields = array(
         'title',
         'url',
         'url_new_window',
         'use_icon',
         'font_icon',
         'icon_color',
         'use_circle',
         'circle_color',
         'use_circle_border',
         'circle_border_color',
         'image',
         'alt',
         'icon_placement',
         'animation',
         'background_layout',
         'text_orientation',
         'content_new',
         'admin_label',
         'module_id',
         'module_class',
         'max_width',
         'use_icon_font_size',
         'icon_font_size',
      );

      $et_accent_color = et_builder_accent_color();

      $this->fields_defaults = array(
         'url_new_window'      => array( 'off' ),
         'use_icon'            => array( 'off' ),
         'icon_color'          => array( $et_accent_color, 'add_default_setting' ),
         'use_circle'          => array( 'off' ),
         'circle_color'        => array( $et_accent_color, 'only_default_setting' ),
         'use_circle_border'   => array( 'off' ),
         'circle_border_color' => array( $et_accent_color, 'only_default_setting' ),
         'icon_placement'      => array( 'top' ),
         'animation'           => array( 'top' ),
         'background_layout'   => array( 'light' ),
         'text_orientation'    => array( 'center' ),
         'use_icon_font_size'  => array( 'off' ),
      );

      $this->advanced_options = array(
         'fonts' => array(
            'header' => array(
               'label'    => __( 'Header', 'et_builder' ),
               'css'      => array(
                  'main' => "{$this->main_css_element} h4, {$this->main_css_element} h4 a",
               ),
            ),
            'body'   => array(
               'label'    => __( 'Body', 'et_builder' ),
               'css'      => array(
                  'line_height' => "{$this->main_css_element} p",
               ),
            ),
         ),
         'background' => array(
            'settings' => array(
               'color' => 'alpha',
            ),
         ),
         'border' => array(),
         'custom_margin_padding' => array(
            'css' => array(
               'important' => 'all',
            ),
         ),
      );
      $this->custom_css_options = array(
         'blurb_image' => array(
            'label'    => __( 'Blurb Image', 'et_builder' ),
            'selector' => '.et_pb_main_blurb_image',
         ),
         'blurb_title' => array(
            'label'    => __( 'Blurb Title', 'et_builder' ),
            'selector' => 'h4',
         ),
         'blurb_content' => array(
            'label'    => __( 'Blurb Content', 'et_builder' ),
            'selector' => '.et_pb_blurb_content',
         ),
      );
   }

   function get_fields() {
      $et_accent_color = et_builder_accent_color();

      $image_icon_placement = array(
         'top' => __( 'Top', 'et_builder' ),
      );

      if ( ! is_rtl() ) {
         $image_icon_placement['left'] = __( 'Left', 'et_builder' );
      } else {
         $image_icon_placement['right'] = __( 'Right', 'et_builder' );
      }

      $fields = array(
         'title' => array(
            'label'           => __( 'Title', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => __( 'The title of your blurb will appear in bold below your blurb image.', 'et_builder' ),
         ),
         'url' => array(
            'label'           => __( 'Url', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => __( 'If you would like to make your blurb a link, input your destination URL here.', 'et_builder' ),
         ),
         'url_new_window' => array(
            'label'           => __( 'Url Opens', 'et_builder' ),
            'type'            => 'select',
            'option_category' => 'configuration',
            'options'         => array(
               'off' => __( 'In The Same Window', 'et_builder' ),
               'on'  => __( 'In The New Tab', 'et_builder' ),
            ),
            'description' => __( 'Here you can choose whether or not your link opens in a new window', 'et_builder' ),
         ),
         'use_icon' => array(
            'label'           => __( 'Use Icon', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'basic_option',
            'options'         => array(
               'off' => __( 'No', 'et_builder' ),
               'on'  => __( 'Yes', 'et_builder' ),
            ),
            'affects'     => array(
               '#et_pb_font_icon',
               '#et_pb_use_circle',
               '#et_pb_icon_color',
               '#et_pb_image',
               '#et_pb_alt',
            ),
            'description' => __( 'Here you can choose whether icon set below should be used.', 'et_builder' ),
         ),
         'font_icon' => array(
            'label'               => __( 'Icon', 'et_builder' ),
            'type'                => 'text',
            'option_category'     => 'basic_option',
            'class'               => array( 'et-pb-font-icon' ),
            'renderer'            => 'et_pb_get_font_icon_list',
            'renderer_with_field' => true,
            'description'         => __( 'Choose an icon to display with your blurb.', 'et_builder' ),
            'depends_default'     => true,
         ),
         'icon_color' => array(
            'label'             => __( 'Icon Color', 'et_builder' ),
            'type'              => 'color-alpha',
            'description'       => __( 'Here you can define a custom color for your icon.', 'et_builder' ),
            'depends_default'   => true,
         ),
         'use_circle' => array(
            'label'           => __( 'Circle Icon', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => array(
               'off' => __( 'No', 'et_builder' ),
               'on'  => __( 'Yes', 'et_builder' ),
            ),
            'affects'           => array(
               '#et_pb_use_circle_border',
               '#et_pb_circle_color',
            ),
            'description' => __( 'Here you can choose whether icon set above should display within a circle.', 'et_builder' ),
            'depends_default'   => true,
         ),
         'circle_color' => array(
            'label'           => __( 'Circle Color', 'et_builder' ),
            'type'            => 'color',
            'description'     => __( 'Here you can define a custom color for the icon circle.', 'et_builder' ),
            'depends_default' => true,
         ),
         'use_circle_border' => array(
            'label'           => __( 'Show Circle Border', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'layout',
            'options'         => array(
               'off' => __( 'No', 'et_builder' ),
               'on'  => __( 'Yes', 'et_builder' ),
            ),
            'affects'           => array(
               '#et_pb_circle_border_color',
            ),
            'description' => __( 'Here you can choose whether if the icon circle border should display.', 'et_builder' ),
            'depends_default'   => true,
         ),
         'circle_border_color' => array(
            'label'           => __( 'Circle Border Color', 'et_builder' ),
            'type'            => 'color',
            'description'     => __( 'Here you can define a custom color for the icon circle border.', 'et_builder' ),
            'depends_default' => true,
         ),
         'image' => array(
            'label'              => __( 'Image', 'et_builder' ),
            'type'               => 'upload',
            'option_category'    => 'basic_option',
            'upload_button_text' => __( 'Upload an image', 'et_builder' ),
            'choose_text'        => __( 'Choose an Image', 'et_builder' ),
            'update_text'        => __( 'Set As Image', 'et_builder' ),
            'depends_show_if'    => 'off',
            'description'        => __( 'Upload an image to display at the top of your blurb.', 'et_builder' ),
         ),
         'alt' => array(
            'label'           => __( 'Image Alt Text', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => __( 'Define the HTML ALT text for your image here.', 'et_builder' ),
            'depends_show_if' => 'off',
         ),
         'icon_placement' => array(
            'label'             => __( 'Image/Icon Placement', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'layout',
            'options'           => $image_icon_placement,
            'description'       => __( 'Here you can choose where to place the icon.', 'et_builder' ),
         ),
         'animation' => array(
            'label'             => __( 'Image/Icon Animation', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'configuration',
            'options'           => array(
               'top'    => __( 'Top To Bottom', 'et_builder' ),
               'left'   => __( 'Left To Right', 'et_builder' ),
               'right'  => __( 'Right To Left', 'et_builder' ),
               'bottom' => __( 'Bottom To Top', 'et_builder' ),
               'off'    => __( 'No Animation', 'et_builder' ),
            ),
            'description'       => __( 'This controls the direction of the lazy-loading animation.', 'et_builder' ),
         ),
         'background_layout' => array(
            'label'             => __( 'Text Color', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'color_option',
            'options'           => array(
               'light' => __( 'Dark', 'et_builder' ),
               'dark'  => __( 'Light', 'et_builder' ),
            ),
            'description'       => __( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
         ),
         'text_orientation' => array(
            'label'             => __( 'Text Orientation', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'layout',
            'options'           => et_builder_get_text_orientation_options(),
            'description'       => __( 'This will control how your blurb text is aligned.', 'et_builder' ),
         ),
         'content_new' => array(
            'label'             => __( 'Content', 'et_builder' ),
            'type'              => 'tiny_mce',
            'option_category'   => 'basic_option',
            'description'       => __( 'Input the main text content for your module here.', 'et_builder' ),
         ),
         'admin_label' => array(
            'label'             => __( 'Admin Label', 'et_builder' ),
            'type'              => 'text',
            'description'       => __( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
         ),
         'module_id' => array(
            'label'             => __( 'CSS ID', 'et_builder' ),
            'type'              => 'text',
            'option_category'   => 'configuration',
            'description'       => __( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'et_builder' ),
         ),
         'module_class' => array(
            'label'             => __( 'CSS Class', 'et_builder' ),
            'type'              => 'text',
            'option_category'   => 'configuration',
            'description'       => __( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'et_builder' ),
         ),
         'max_width' => array(
            'label'           => __( 'Image Max Width', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'layout',
            'tab_slug'        => 'advanced',
         ),
         'use_icon_font_size' => array(
            'label'           => __( 'Use Icon Font Size', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'font_option',
            'options'         => array(
               'off' => __( 'No', 'et_builder' ),
               'on'  => __( 'Yes', 'et_builder' ),
            ),
            'affects'     => array(
               '#et_pb_icon_font_size',
            ),
            'tab_slug' => 'advanced',
         ),
         'icon_font_size' => array(
            'label'           => __( 'Icon Font Size', 'et_builder' ),
            'type'            => 'range',
            'option_category' => 'font_option',
            'tab_slug'        => 'advanced',
            'depends_default' => true,
         ),
      );
      return $fields;
   }

   function shortcode_callback( $atts, $content = null, $function_name ) {
      $module_id             = $this->shortcode_atts['module_id'];
      $module_class          = $this->shortcode_atts['module_class'];
      $title                 = $this->shortcode_atts['title'];
      $url                   = $this->shortcode_atts['url'];
      $image                 = $this->shortcode_atts['image'];
      $url_new_window        = $this->shortcode_atts['url_new_window'];
      $alt                   = $this->shortcode_atts['alt'];
      $background_layout     = $this->shortcode_atts['background_layout'];
      $text_orientation      = $this->shortcode_atts['text_orientation'];
      $animation             = $this->shortcode_atts['animation'];
      $icon_placement        = $this->shortcode_atts['icon_placement'];
      $font_icon             = $this->shortcode_atts['font_icon'];
      $use_icon              = $this->shortcode_atts['use_icon'];
      $use_circle            = $this->shortcode_atts['use_circle'];
      $use_circle_border     = $this->shortcode_atts['use_circle_border'];
      $icon_color            = $this->shortcode_atts['icon_color'];
      $circle_color          = $this->shortcode_atts['circle_color'];
      $circle_border_color   = $this->shortcode_atts['circle_border_color'];
      $max_width             = $this->shortcode_atts['max_width'];
      $use_icon_font_size    = $this->shortcode_atts['use_icon_font_size'];
      $icon_font_size        = $this->shortcode_atts['icon_font_size'];

      $module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

      if ( 'off' !== $use_icon_font_size ) {
         ET_Builder_Element::set_style( $function_name, array(
            'selector'    => '%%order_class%% .et-pb-icon',
            'declaration' => sprintf(
               'font-size: %1$s;',
               esc_html( et_builder_process_range_value( $icon_font_size ) )
            ),
         ) );
      }

      if ( '' !== $max_width ) {
         ET_Builder_Element::set_style( $function_name, array(
            'selector'    => '%%order_class%% .et_pb_main_blurb_image img',
            'declaration' => sprintf(
               'max-width: %1$s;',
               esc_html( et_builder_process_range_value( $max_width ) )
            ),
         ) );
      }

      if ( is_rtl() && 'left' === $text_orientation ) {
         $text_orientation = 'right';
      }

      if ( is_rtl() && 'left' === $icon_placement ) {
         $icon_placement = 'right';
      }

      if ( '' !== $title ) {
         $title = "<h4>{$title}</h4>";
      }

      if ( '' !== trim( $image ) || '' !== $font_icon ) {
         if ( 'off' === $use_icon ) {
            $image = sprintf(
               '<img src="%1$s" alt="%2$s" class="et-waypoint%3$s" />',
               esc_attr( $image ),
               esc_attr( $alt ),
               esc_attr( " et_pb_animation_{$animation}" )
            );
         } else {
            $icon_style = sprintf( 'color: %1$s;', esc_attr( $icon_color ) );

            if ( 'on' === $use_circle ) {
               $icon_style .= sprintf( ' background-color: %1$s;', esc_attr( $circle_color ) );

               if ( 'on' === $use_circle_border ) {
                  $icon_style .= sprintf( ' border-color: %1$s;', esc_attr( $circle_border_color ) );
               }
            }

            $image = sprintf(
               '<span class="et-pb-icon et-waypoint%2$s%3$s%4$s" style="%5$s">%1$s</span>',
               esc_attr( et_pb_process_font_icon( $font_icon ) ),
               esc_attr( " et_pb_animation_{$animation}" ),
               ( 'on' === $use_circle ? ' et-pb-icon-circle' : '' ),
               ( 'on' === $use_circle && 'on' === $use_circle_border ? ' et-pb-icon-circle-border' : '' ),
               $icon_style
            );
         }
      }

      $class = " et_pb_module et_pb_bg_layout_{$background_layout} et_pb_text_align_{$text_orientation}";

      $output = sprintf(
         '<a href="%8$s" %9$s>
         <div%5$s class="et_pb_blurb%4$s%6$s%7$s">
            <div class="et_pb_blurb_content">
               <div class="et_pb_main_blurb_image"> 
                 %2$s 
               </div>
               <div class="et_pb_blurb_container">
                     %3$s
                     %1$s
               </div>
            </div> <!-- .et_pb_blurb_content -->
            
         </div> <!-- .et_pb_blurb -->
         </a>',
         $this->shortcode_content,
         $image,
         $title,
         esc_attr( $class ),
         ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
         ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
         sprintf( ' et_pb_blurb_position_%1$s', esc_attr( $icon_placement ) ),
         esc_url( $url ),
         ( 'on' === $url_new_window ? ' target="_blank"' : '' )
      );

      return $output;
   }
}
new FDL_Builder_Module_Clickable_Blurb();
