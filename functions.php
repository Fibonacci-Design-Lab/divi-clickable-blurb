function divi_child_theme_setup() {
   if ( class_exists('ET_Builder_Module')) {
      get_template_part( 'custom-modules/clickable_blurb' );

      $cbm2 = new FDL_Builder_Module_Clickable_Blurb();

      add_shortcode( 'et_pb_blurb2', array($cbm2, '_shortcode_callback') );
   }
}
add_action('et_builder_ready', 'divi_child_theme_setup');
