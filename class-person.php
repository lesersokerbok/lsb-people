<?php

	namespace LSB\People;

	class PersonContentType {
  	public function __construct() {
			add_action( 'init', array( &$this, 'register_post_type_lsb_person' ) );
			add_action( 'init', array( &$this, 'register_lsb_person_image_size' ) );
			add_action( 'acf/init', array( &$this, 'register_lsb_person_custom_fields' ) );
			add_action( 'acf/init', array( &$this, 'register_lsb_person_relationship' ) );
  	}

  	public function register_post_type_lsb_person() {
      $labels = array(
    		'name'                => _x( 'Personer', 'Post Type General Name', 'lsb_main' ),
    		'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'lsb_main' ),
    		'menu_name'           => __( 'Person', 'lsb_main' ),
    		'parent_item_colon'   => __( '', 'lsb_main' ),
    		'all_items'           => __( 'Alle personer', 'lsb_main' ),
    		'view_item'           => __( 'Se person', 'lsb_main' ),
    		'add_new_item'        => __( 'Legg til person', 'lsb_main' ),
    		'add_new'             => __( 'Legg til ny', 'lsb_main' ),
    		'edit_item'           => __( 'Rediger person', 'lsb_main' ),
    		'update_item'         => __( 'Oppdater person', 'lsb_main' ),
    		'search_items'        => __( 'Søk i personer', 'lsb_main' ),
    		'not_found'           => __( 'Ikke funnet', 'lsb_main' ),
    		'not_found_in_trash'  => __( 'Ikke funnet i søppelkurven', 'lsb_main' ),
    	);
    	$args = array(
    		'label'               => __( 'lsb-person', 'lsb_main' ),
    		'description'         => __( 'Personer', 'lsb_main' ),
    		'labels'              => $labels,
    		'supports'            => array( 'title' ),
    		'hierarchical'        => false,
    		'public'              => true,
    		'show_ui'             => true,
    		'show_in_menu'        => true,
    		'show_in_nav_menus'   => true,
    		'show_in_admin_bar'   => true,
    		'menu_position'       => 5,
    		'can_export'          => true,
    		'has_archive'         => false,
    		'exclude_from_search' => false,
    		'publicly_queryable'  => true,
    		'capability_type'     => 'page',
        'rewrite'             => array('slug' => 'person'),
    	);
    	register_post_type( 'lsb-person', $args );
  	}

  	public function register_lsb_person_custom_fields() {
      register_field_group(array (
        'key' => 'lsb_custom_field_group_person',
        'title' => __('Person', 'lsb_main'),
        'fields' => array (
      		array (
      			'key' => 'lsb_custom_field_person_role',
      			'label' => 'Rolle',
      			'name' => 'role',
      			'prefix' => '',
      			'type' => 'radio',
      			'instructions' => '',
      			'required' => 1,
      			'conditional_logic' => 0,
      			'choices' => array (
      				'employee' => 'Ansatt',
      				'boardMember' => 'Styremedlem',
      			),
      			'other_choice' => 0,
      			'save_other_choice' => 0,
      			'default_value' => 'employee',
      			'layout' => 'vertical',
      		),
      		array (
      			'key' => 'lsb_custom_field_person_company',
      			'label' => 'Selskap',
      			'name' => 'company',
      			'prefix' => '',
      			'type' => 'text',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => array (
      				array (
      					'rule_rule_0' => array (
      						'field' => 'lsb_custom_field_person_role',
      						'operator' => '==',
      						'value' => 'boardMember',
      					),
      				),
      			),
      			'default_value' => '',
      			'placeholder' => '',
      			'prepend' => '',
      			'append' => '',
      			'maxlength' => '',
      			'readonly' => 0,
      			'disabled' => 0,
      		),
          array (
            'key' => 'lsb_custom_field_person_company_url',
            'label' => 'Selskapslenke',
            'name' => 'company_url',
            'prefix' => '',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array (
              array (
                'rule_rule_0' => array (
                  'field' => 'lsb_custom_field_person_role',
                  'operator' => '==',
                  'value' => 'boardMember',
                ),
              ),
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'readonly' => 0,
            'disabled' => 0,
          ),
          array (
            'key' => 'lsb_custom_field_person_photo',
            'label' => __('Foto', 'lsb_main'),
            'name' => 'photo',
            'prefix' => '',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'return_format' => 'object',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array (
      			'key' => 'lsb_custom_field_person_phone',
      			'label' => __('Telefon', 'lsb_main'),
      			'name' => 'phone',
      			'prefix' => '',
      			'type' => 'text',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => array (
              array (
                'rule_rule_0' => array (
                  'field' => 'lsb_custom_field_person_role',
                  'operator' => '==',
                  'value' => 'employee',
                ),
              ),
            ),
      			'default_value' => '',
      			'placeholder' => '',
      			'prepend' => '',
      			'append' => '',
      			'maxlength' => '',
      			'readonly' => 0,
      			'disabled' => 0,
      		),
          array (
            'key' => 'lsb_custom_field_person_mobile',
            'label' => __('Mobil', 'lsb_main'),
            'name' => 'mobile',
            'prefix' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array (
              array (
                'rule_rule_0' => array (
                  'field' => 'lsb_custom_field_person_role',
                  'operator' => '==',
                  'value' => 'employee',
                ),
              ),
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'readonly' => 0,
            'disabled' => 0,
          ),
      		array (
      			'key' => 'lsb_custom_field_person_email',
      			'label' => __('E-post', 'lsb_main'),
      			'name' => 'email',
      			'prefix' => '',
      			'type' => 'email',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => array (
              array (
                'rule_rule_0' => array (
                  'field' => 'lsb_custom_field_person_role',
                  'operator' => '==',
                  'value' => 'employee',
                ),
              ),
            ),
      			'default_value' => '',
      			'placeholder' => '',
      			'prepend' => '',
      			'append' => '',
      		),
      		array (
      			'key' => 'lsb_custom_field_person_links',
      			'label' => __('Lenker', 'lsb_main'),
      			'name' => 'links',
      			'prefix' => '',
      			'type' => 'repeater',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'min' => '',
      			'max' => '',
      			'layout' => 'table',
      			'button_label' => __('Legg til', 'lsb_main'),
      			'sub_fields' => array (
      				array (
      					'key' => 'lsb_custom_field_person_link_tag',
      					'label' => __('Tittel', 'lsb_main'),
      					'name' => 'tag',
      					'prefix' => '',
      					'type' => 'text',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'column_width' => '',
      					'default_value' => '',
      					'placeholder' => '',
      					'prepend' => '',
      					'append' => '',
      					'maxlength' => '',
      					'readonly' => 0,
      					'disabled' => 0,
      				),
      				array (
      					'key' => 'lsb_custom_field_person_link_url',
      					'label' => __('URL', 'lsb_main'),
      					'name' => 'url',
      					'prefix' => '',
      					'type' => 'text',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'column_width' => '',
      					'default_value' => '',
      					'placeholder' => '',
      					'prepend' => '',
      					'append' => '',
      					'maxlength' => '',
      					'readonly' => 0,
      					'disabled' => 0,
      				),
      			),
      		),
      		array (
      			'key' => 'lsb_custom_field_person_bio',
      			'label' => __('Beskrivelse', 'lsb_main'),
      			'name' => 'bio',
      			'prefix' => '',
      			'type' => 'wysiwyg',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'default_value' => '',
      			'toolbar' => 'basic',
      			'media_upload' => 0,
      		),
        ),
        'location' => array (
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'lsb-person',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'normal',
      	'style' => 'seamless',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => array (
      		1 => 'the_content',
      		2 => 'excerpt',
      		3 => 'custom_fields',
      		4 => 'discussion',
      		5 => 'comments',
      		6 => 'revisions',
      		7 => 'slug',
      		8 => 'author',
      		9 => 'format',
      		10 => 'page_attributes',
      		11 => 'featured_image',
      		12 => 'categories',
      		13 => 'tags',
      		14 => 'send-trackbacks',
      	),
      ));
  	}

  	public function register_lsb_person_relationship() {

    register_field_group(array (
    	'key' => 'lsb_custom_field_group_people',
    	'title' => __('Personer', 'lsb_main'),
    	'fields' => array (
    		array (
    			'key' => 'lsb_custom_field_person_relationship',
    			'label' => 'Legg til personer',
    			'name' => 'person_relationship',
    			'prefix' => '',
    			'type' => 'relationship',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'post_type' => array (
    				0 => 'lsb-person',
    			),
    			'taxonomy' => '',
    			'filters' => array (
    				0 => 'search',
    			),
    			'elements' => '',
    			'max' => '',
    			'return_format' => 'object',
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'page_template',
    				'operator' => '==',
    				'value' => 'template-people.php',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
      'hide_on_screen' => '',
    ));
  }

  public function register_lsb_person_image_size() {
    add_image_size( "lsb_person_image_size", 350);
  }
}
