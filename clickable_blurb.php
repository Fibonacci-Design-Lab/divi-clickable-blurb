<?php
class FDL_Builder_Module_Clickable_Blurb extends ET_Builder_Module {
   function init() {
      $this->name             = esc_html__( 'Clickable Blurb', 'et_builder' );
      $this->slug             = 'et_pb_blurb2';
      $this->fb_support       = true;
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
         'max_width_tablet',
         'max_width_phone',
         'icon_font_size_tablet',
         'icon_font_size_phone',
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
               'label'    => esc_html__( 'Header', 'et_builder' ),
               'css'      => array(
                  'main' => "{$this->main_css_element} h4, {$this->main_css_element} h4 a",
               ),
            ),
            'body'   => array(
               'label'    => esc_html__( 'Body', 'et_builder' ),
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
            'label'    => esc_html__( 'Blurb Image', 'et_builder' ),
            'selector' => '.et_pb_main_blurb_image',
         ),
         'blurb_title' => array(
            'label'    => esc_html__( 'Blurb Title', 'et_builder' ),
            'selector' => 'h4',
         ),
         'blurb_content' => array(
            'label'    => esc_html__( 'Blurb Content', 'et_builder' ),
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
         $image_icon_placement['left'] = esc_html__( 'Left', 'et_builder' );
      } else {
         $image_icon_placement['right'] = esc_html__( 'Right', 'et_builder' );
      }

      $fields = array(
         'title' => array(
            'label'           => esc_html__( 'Title', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => esc_html__( 'The title of your blurb will appear in bold below your blurb image.', 'et_builder' ),
         ),
         'url' => array(
            'label'           => esc_html__( 'Url', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => esc_html__( 'If you would like to make your blurb a link, input your destination URL here.', 'et_builder' ),
         ),
         'url_new_window' => array(
            'label'           => esc_html__( 'Url Opens', 'et_builder' ),
            'type'            => 'select',
            'option_category' => 'configuration',
            'options'         => array(
               'off' => esc_html__( 'In The Same Window', 'et_builder' ),
               'on'  => esc_html__( 'In The New Tab', 'et_builder' ),
            ),
            'description' => esc_html__( 'Here you can choose whether or not your link opens in a new window', 'et_builder' ),
         ),
         'use_icon' => array(
            'label'           => esc_html__( 'Use Icon', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'basic_option',
            'options'         => array(
               'off' => esc_html__( 'No', 'et_builder' ),
               'on'  => esc_html__( 'Yes', 'et_builder' ),
            ),
            'affects'     => array(
               'font_icon',
               'use_circle',
               'icon_color',
               'image',
               'alt',
            ),
            'description' => esc_html__( 'Here you can choose whether icon set below should be used.', 'et_builder' ),
         ),
         'font_icon' => array(
            'label'               => esc_html__( 'Icon', 'et_builder' ),
            'type'                => 'text',
            'option_category'     => 'basic_option',
            'class'               => array( 'et-pb-font-icon' ),
            'renderer'            => 'et_pb_get_font_icon_list',
            'renderer_with_field' => true,
            'description'         => esc_html__( 'Choose an icon to display with your blurb.', 'et_builder' ),
            'depends_default'     => true,
         ),
         'icon_color' => array(
            'label'             => esc_html__( 'Icon Color', 'et_builder' ),
            'type'              => 'color-alpha',
            'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'et_builder' ),
            'depends_default'   => true,
         ),
         'use_circle' => array(
            'label'           => esc_html__( 'Circle Icon', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => array(
               'off' => esc_html__( 'No', 'et_builder' ),
               'on'  => esc_html__( 'Yes', 'et_builder' ),
            ),
            'affects'           => array(
               'use_circle_border',
               'circle_color',
            ),
            'description' => esc_html__( 'Here you can choose whether icon set above should display within a circle.', 'et_builder' ),
            'depends_default'   => true,
         ),
         'circle_color' => array(
            'label'           => esc_html__( 'Circle Color', 'et_builder' ),
            'type'            => 'color',
            'description'     => esc_html__( 'Here you can define a custom color for the icon circle.', 'et_builder' ),
            'depends_default' => true,
         ),
         'use_circle_border' => array(
            'label'           => esc_html__( 'Show Circle Border', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'layout',
            'options'         => array(
               'off' => esc_html__( 'No', 'et_builder' ),
               'on'  => esc_html__( 'Yes', 'et_builder' ),
            ),
            'affects'           => array(
               'circle_border_color',
            ),
            'description' => esc_html__( 'Here you can choose whether if the icon circle border should display.', 'et_builder' ),
            'depends_default'   => true,
         ),
         'circle_border_color' => array(
            'label'           => esc_html__( 'Circle Border Color', 'et_builder' ),
            'type'            => 'color',
            'description'     => esc_html__( 'Here you can define a custom color for the icon circle border.', 'et_builder' ),
            'depends_default' => true,
         ),
         'image' => array(
            'label'              => esc_html__( 'Image', 'et_builder' ),
            'type'               => 'upload',
            'option_category'    => 'basic_option',
            'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
            'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
            'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
            'depends_show_if'    => 'off',
            'description'        => esc_html__( 'Upload an image to display at the top of your blurb.', 'et_builder' ),
         ),
         'alt' => array(
            'label'           => esc_html__( 'Image Alt Text', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => esc_html__( 'Define the HTML ALT text for your image here.', 'et_builder' ),
            'depends_show_if' => 'off',
         ),
         'icon_placement' => array(
            'label'             => esc_html__( 'Image/Icon Placement', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'layout',
            'options'           => $image_icon_placement,
            'description'       => esc_html__( 'Here you can choose where to place the icon.', 'et_builder' ),
         ),
         'animation' => array(
            'label'             => esc_html__( 'Image/Icon Animation', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'configuration',
            'options'           => array(
               'top'    => esc_html__( 'Top To Bottom', 'et_builder' ),
               'left'   => esc_html__( 'Left To Right', 'et_builder' ),
               'right'  => esc_html__( 'Right To Left', 'et_builder' ),
               'bottom' => esc_html__( 'Bottom To Top', 'et_builder' ),
               'off'    => esc_html__( 'No Animation', 'et_builder' ),
            ),
            'description'       => esc_html__( 'This controls the direction of the lazy-loading animation.', 'et_builder' ),
         ),
         'background_layout' => array(
            'label'             => esc_html__( 'Text Color', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'color_option',
            'options'           => array(
               'light' => esc_html__( 'Dark', 'et_builder' ),
               'dark'  => esc_html__( 'Light', 'et_builder' ),
            ),
            'description'       => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
         ),
         'text_orientation' => array(
            'label'             => esc_html__( 'Text Orientation', 'et_builder' ),
            'type'              => 'select',
            'option_category'   => 'layout',
            'options'           => et_builder_get_text_orientation_options(),
            'description'       => esc_html__( 'This will control how your blurb text is aligned.', 'et_builder' ),
         ),
         'content_new' => array(
            'label'             => esc_html__( 'Content', 'et_builder' ),
            'type'              => 'tiny_mce',
            'option_category'   => 'basic_option',
            'description'       => esc_html__( 'Input the main text content for your module here.', 'et_builder' ),
         ),
         'max_width' => array(
            'label'           => esc_html__( 'Image Max Width', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'layout',
            'tab_slug'        => 'advanced',
            'mobile_options'  => true,
            'validate_unit'   => true,
         ),
         'use_icon_font_size' => array(
            'label'           => esc_html__( 'Use Icon Font Size', 'et_builder' ),
            'type'            => 'yes_no_button',
            'option_category' => 'font_option',
            'options'         => array(
               'off' => esc_html__( 'No', 'et_builder' ),
               'on'  => esc_html__( 'Yes', 'et_builder' ),
            ),
            'affects'     => array(
               'icon_font_size',
            ),
            'tab_slug' => 'advanced',
         ),
         'icon_font_size' => array(
            'label'           => esc_html__( 'Icon Font Size', 'et_builder' ),
            'type'            => 'range',
            'option_category' => 'font_option',
            'tab_slug'        => 'advanced',
            'default'         => '96px',
            'range_settings' => array(
               'min'  => '1',
               'max'  => '120',
               'step' => '1',
            ),
            'mobile_options'  => true,
            'depends_default' => true,
         ),
         'max_width_tablet' => array (
            'type'     => 'skip',
            'tab_slug' => 'advanced',
         ),
         'max_width_phone' => array (
            'type'     => 'skip',
            'tab_slug' => 'advanced',
         ),
         'icon_font_size_tablet' => array(
            'type'     => 'skip',
            'tab_slug' => 'advanced',
         ),
         'icon_font_size_phone' => array(
            'type'     => 'skip',
            'tab_slug' => 'advanced',
         ),
         'disabled_on' => array(
            'label'           => esc_html__( 'Disable on', 'et_builder' ),
            'type'            => 'multiple_checkboxes',
            'options'         => array(
               'phone'   => esc_html__( 'Phone', 'et_builder' ),
               'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
               'desktop' => esc_html__( 'Desktop', 'et_builder' ),
            ),
            'additional_att'  => 'disable_on',
            'option_category' => 'configuration',
            'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
         ),
         'admin_label' => array(
            'label'       => esc_html__( 'Admin Label', 'et_builder' ),
            'type'        => 'text',
            'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
         ),
         'module_id' => array(
            'label'           => esc_html__( 'CSS ID', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'configuration',
            'tab_slug'        => 'custom_css',
            'option_class'    => 'et_pb_custom_css_regular',
         ),
         'module_class' => array(
            'label'           => esc_html__( 'CSS Class', 'et_builder' ),
            'type'            => 'text',
            'option_category' => 'configuration',
            'tab_slug'        => 'custom_css',
            'option_class'    => 'et_pb_custom_css_regular',
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
      $max_width_tablet      = $this->shortcode_atts['max_width_tablet'];
      $max_width_phone       = $this->shortcode_atts['max_width_phone'];
      $use_icon_font_size    = $this->shortcode_atts['use_icon_font_size'];
      $icon_font_size        = $this->shortcode_atts['icon_font_size'];
      $icon_font_size_tablet = $this->shortcode_atts['icon_font_size_tablet'];
      $icon_font_size_phone  = $this->shortcode_atts['icon_font_size_phone'];

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
                  %2$s
               <div class="et_pb_blurb_container"> 
                      %3$s
                     %1$s
               </div>
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
new FDL_Builder_Module_Card_Blurb();
