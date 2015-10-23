<?php 

/*
*  Field Group
*
*  @description: All the functionality for creating / editing a field group
*  @since 3.2.6
*  @created: 23/06/12
*/

 
class acf_field_group
{

	var $parent,
		$data;
		
	
	/*
	*  __construct
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function __construct($parent)
	{
	
		// vars
		$this->parent = $parent;
		
		
		// filters
		add_filter('name_save_pre', array($this, 'save_name'));
		
		
		// actions
		add_action('admin_print_scripts', array($this,'admin_print_scripts'));
		add_action('admin_print_styles', array($this,'admin_print_styles'));
		add_action('admin_head', array($this,'admin_head'));
		add_action('save_post', array($this, 'save_post'));
		
		
		// ajax
		add_action('wp_ajax_acf_field_options', array($this, 'ajax_acf_field_options'));
		add_action('wp_ajax_acf_location', array($this, 'ajax_acf_location'));
	}
	
	
	/*
	*  validate_page
	*
	*  @description: returns true | false. Used to stop a function from continuing
	*  @since 3.2.6
	*  @created: 23/06/12
	*/
	
	function validate_page()
	{
		// global
		global $pagenow, $typenow;
		
		
		// vars
		$return = false;
		
		
		// validate page
		if( in_array( $pagenow, array('post.php', 'post-new.php') ) )
		{
		
			// validate post type
			if( $typenow == "acf" )
			{
				$return = true;
			}
			
		}
		
		
		// return
		return $return;
	}
	
	
	
	/*
	*  admin_print_scripts
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function admin_print_scripts()
	{
		// validate page
		if( ! $this->validate_page() ) return;
		
		wp_dequeue_script( 'autosave' );
		do_action('acf_print_scripts-fields');
	}
	
	
	/*
	*  admin_print_styles
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function admin_print_styles()
	{
		// validate page
		if( ! $this->validate_page() ) return;
		
		do_action('acf_print_styles-fields');
	}
	
	
	/*
	*  admin_head
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function admin_head()
	{
		// validate page
		if( ! $this->validate_page() ) return;
		
		
		// add acf fields js + css
		/*echo '<script type="text/javascript" src="' . $this->parent->dir . '/js/fields.js?ver=' . $this->parent->version . '" ></script>';
		echo '<link rel="stylesheet" type="text/css" href="' . $this->parent->dir . '/css/global.css?ver=' . $this->parent->version . '" />';
		echo '<link rel="stylesheet" type="text/css" href="' . $this->parent->dir . '/css/fields.css?ver=' . $this->parent->version . '" />';*/
		
		$template_url = get_template_directory_uri()."/acf/";
		echo '<script type="text/javascript" src="' . $template_url . '/js/fields.js?ver=' . $this->parent->version . '" ></script>';
		echo '<link rel="stylesheet" type="text/css" href="' . $template_url . '/css/global.css?ver=' . $this->parent->version . '" />';
		echo '<link rel="stylesheet" type="text/css" href="' . $template_url . '/css/fields.css?ver=' . $this->parent->version . '" />';
		
		
		// add user js + css
		do_action('acf_head-fields');
		
		
		// add metaboxes
		add_meta_box('acf_fields', __("Fields",'acf'), array($this, 'meta_box_fields'), 'acf', 'normal', 'high');
		add_meta_box('acf_location', __("Location",'acf'), array($this, 'meta_box_location'), 'acf', 'normal', 'high');
		add_meta_box('acf_options', __("Options",'acf'), array($this, 'meta_box_options'), 'acf', 'normal', 'high');
		
		
		// add screen settings
		add_filter('screen_settings', array($this, 'screen_settings'), 10, 1);
	}
	
	
	/*
	*  screen_settings
	*
	*  @description: 
	*  @created: 4/09/12
	*/
	
	function screen_settings( $current )
	{
	    $current .= '<h5>' . __("Fields",'acf') . '</h5>';
	    
	    $current .= '<div class="show-field_key">Show Field Key:';
	    	 $current .= '<label class="show-field_key-no"><input checked="checked" type="radio" value="0" name="show-field_key" /> No</label>';
	    	 $current .= '<label class="show-field_key-yes"><input type="radio" value="1" name="show-field_key" /> Yes</label>';
		$current .= '</div>';
	    
	    return $current;
	}
	
	
	/*
	*  meta_box_fields
	*
	*  @description: 
	*  @since 1.0.0
	*  @created: 23/06/12
	*/
	
	function meta_box_fields()
	{
		include( $this->parent->path . 'core/views/meta_box_fields.php' );
	}
	
	
	/*
	*  meta_box_location
	*
	*  @description: 
	*  @since 1.0.0
	*  @created: 23/06/12
	*/

	function meta_box_location()
	{
		include( $this->parent->path . 'core/views/meta_box_location.php' );
	}
	
	
	/*
	*  meta_box_options
	*
	*  @description: 
	*  @since 1.0.0
	*  @created: 23/06/12
	*/
	
	function meta_box_options()
	{
		include( $this->parent->path . 'core/views/meta_box_options.php' );
	}
	
	
	/*
	*  ajax_acf_field_options
	*
	*  @description: creates the HTML for a field's options (field group edit page)
	*  @since 3.1.6
	*  @created: 23/06/12
	*/
	
	function ajax_acf_field_options()
	{
		// defaults
		$defaults = array(
			'field_key' => null,
			'field_type' => null,
			'post_id' => null,
		);
		
		// load post options
		$options = array_merge($defaults, $_POST);
		
		// required
		if(!$options['field_type'])
		{
			echo "";
			die();
		}
		
		$options['field_key'] = str_replace("fields[", "", $options['field_key']);
		$options['field_key'] = str_replace("][type]", "", $options['field_key']) ;
		
		
		// load field
		//$field = $this->get_acf_field("field_" . $options['field_key'], $options['post_id']);
		$field = array();
		
		// render options
		$this->parent->fields[$options['field_type']]->create_options($options['field_key'], $field);
		die();
		
	}
	
	
	/*
	*  ajax_acf_location
	*
	*  @description: creates the HTML for the field group location metabox. Called from both Ajax and PHP
	*  @since 3.1.6
	*  @created: 23/06/12
	*/
	
	function ajax_acf_location($options = array())
	{
		// defaults
		$defaults = array(
			'key' => null,
			'value' => null,
			'param' => null,
		);
		
		// Is AJAX call?
		if(isset($_POST['action']) && $_POST['action'] == "acf_location")
		{
			$options = array_merge($defaults, $_POST);
		}
		else
		{
			$options = array_merge($defaults, $options);
		}
		
		
		// some case's have the same outcome
		if($options['param'] == "page_parent")
		{
			$options['param'] = "page";
		}

		
		$choices = array();
		$optgroup = false;
		
		switch($options['param'])
		{
			case "post_type":
				
				$choices = get_post_types(array(
					'public' => true
				));
				
				unset($choices['attachment']);
		
				break;
			
			
			case "page":
				
				$pages = get_pages(array(
					'numberposts' => -1,
					'post_type' => 'page',
					'sort_column' => 'menu_order',
					'order' => 'ASC',
					'post_status' => array('publish', 'private', 'draft', 'inherit', 'future'),
					'suppress_filters' => false,
				));

				foreach($pages as $page)
				{
					$title = '';
					$ancestors = get_ancestors($page->ID, 'page');
					if($ancestors)
					{
						foreach($ancestors as $a)
						{
							$title .= '- ';
						}
					}
					
					$title .= apply_filters( 'the_title', $page->post_title, $page->ID );
					
					
					// status
					if($page->post_status != "publish")
					{
						$title .= " ($page->post_status)";
					}
					
					$choices[$page->ID] = $title;
					
				}
				
				break;
			
			
			case "page_type" :
				
				$choices = array(
					'parent'	=>	__("Parent Page",'acf'),
					'child'		=>	__("Child Page",'acf'),
				);
								
				break;
				
			case "page_template" :
				
				$choices = array(
					'default'	=>	__("Default Template",'acf'),
				);
				
				$templates = get_page_templates();
				foreach($templates as $k => $v)
				{
					$choices[$v] = $k;
				}
				
				break;
			
			case "post" :
				
				$posts = get_posts(array(
					'numberposts' => '-1',
					'post_status' => array('publish', 'private', 'draft', 'inherit', 'future'),
					'suppress_filters' => false,
				));
				
				foreach($posts as $post)
				{
					$title = apply_filters( 'the_title', $post->post_title, $post->ID );
					
					// status
					if($post->post_status != "publish")
					{
						$title .= " ($post->post_status)";
					}
					
					$choices[$post->ID] = $title;
				}
				
				break;
			
			case "post_category" :
				
				$category_ids = get_all_category_ids();
		
				foreach($category_ids as $cat_id) 
				{
				  $cat_name = get_cat_name($cat_id);
				  $choices[$cat_id] = $cat_name;
				}
				
				break;
			
			case "post_format" :
				
				$choices = get_post_format_strings();
								
				break;
			
			case "user_type" :
				
				global $wp_roles;
				
				$choices = $wp_roles->get_names();
								
				break;
			
			case "options_page" :
				
				$choices = array(
					__('Options','acf') => __('Options','acf'), 
				);
					
				$custom = apply_filters('acf_register_options_page',array());
				if(!empty($custom))
				{	
					$choices = array();
					foreach($custom as $c)
					{
						$choices[$c['slug']] = $c['title'];
					}
				}
								
				break;
			
			case "taxonomy" :
				
				$choices = $this->parent->get_taxonomies_for_select( array('simple_value' => true) );
				$optgroup = true;
								
				break;
			
			case "ef_taxonomy" :
				
				$choices = array('all' => __('All', 'acf'));
				$taxonomies = get_taxonomies( array('public' => true), 'objects' );
				
				foreach($taxonomies as $taxonomy)
				{
					$choices[ $taxonomy->name ] = $taxonomy->labels->name;
				}
				
				// unset post_format (why is this a public taxonomy?)
				if( isset($choices['post_format']) )
				{
					unset( $choices['post_format']) ;
				}
			
								
				break;
			
			case "ef_user" :
				
				global $wp_roles;
				
				$choices = array_merge( array('all' => __('All', 'acf')), $wp_roles->get_names() );
			
				break;
				
				
			case "ef_media" :
				
				$choices = array('all' => __('All', 'acf'));
			
				break;
				
		}
		
		$this->parent->create_field(array(
			'type'	=>	'select',
			'name'	=>	'location[rules][' . $options['key'] . '][value]',
			'value'	=>	$options['value'],
			'choices' => $choices,
			'optgroup' => $optgroup,
		));
		
		// ajax?
		if(isset($_POST['action']) && $_POST['action'] == "acf_location")
		{
			die();
		}
								
	}	
	
	
	/*
	*  save_name
	*
	*  @description: intercepts the acf post obejct and adds an "acf_" to the start of 
	*				 it's name to stop conflicts between acf's and page's urls
	*  @since 1.0.0
	*  @created: 23/06/12
	*/
		
	function save_name($name)
	{
        if (isset($_POST['post_type']) && $_POST['post_type'] == 'acf') 
        {
			$name = 'acf_' . sanitize_title_with_dashes($_POST['post_title']);
        }
        
        return $name;
	}
	
	
	/*
	*  save_post
	*
	*  @description: Saves the field / location / option data for a field group
	*  @since 1.0.0
	*  @created: 23/06/12
	*/
	
	function save_post($post_id)
	{	
		
		// do not save if this is an auto save routine
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		
		
		// only for save acf
		if( ! isset($_POST['save_fields']) || $_POST['save_fields'] != 'true')
		{
			return $post_id;
		}
		
		
		// only save once! WordPress save's a revision as well.
		if( wp_is_post_revision($post_id) )
		{
	    	return $post_id;
        }
		
		
		/*
		*  save fields
		*/
		
		$fields = $_POST['fields'];
		
		// get all keys to find fields
		$dont_delete = array();
		
		if($fields)
		{
			$i = -1;
			
			// remove dummy field
			unset($fields['999']);
			
			// loop through and save fields
			foreach($fields as $field)
			{
				$i++;
				
				// each field has a unique id!
				if(!isset($field['key'])) $field['key'] = 'field_' . uniqid();
				
				// add to dont delete array
				$dont_delete[] = $field['key'];
				
				// order
				$field['order_no'] = $i;
				
				// update field
				$this->parent->update_field($post_id, $field);
			}
		}
		
		// delete all other field
		foreach(get_post_custom_keys($post_id) as $key)
		{
			if(strpos($key, 'field_') !== false && !in_array($key, $dont_delete))
			{
				// this is a field, and it wasn't found in the dont_delete array
				delete_post_meta($post_id, $key);
			}
		}
		
		
		/*
		*  save location rules
		*/
		
		$location = $_POST['location'];
		
		if( ! isset($location['allorany']) )
		{
			$location['allorany'] = 'all';
		}
		update_post_meta($post_id, 'allorany', $location['allorany']);
		
		delete_post_meta($post_id, 'rule');
		if($location['rules'])
		{
			foreach($location['rules'] as $k => $rule)
			{
				$rule['order_no'] = $k;
				add_post_meta($post_id, 'rule', $rule);
			}
		}
		
		
		/*
		*  save options
		*/
		
		$options = $_POST['options'];
		
		if(!isset($options['position'])) { $options['position'] = 'normal'; }
		if(!isset($options['layout'])) { $options['layout'] = 'default'; }
		if(!isset($options['hide_on_screen'])) { $options['hide_on_screen'] = array(); }
		
		update_post_meta($post_id, 'position', $options['position']);
		update_post_meta($post_id, 'layout', $options['layout']);
		update_post_meta($post_id, 'hide_on_screen', $options['hide_on_screen']);
		
	
		
	}
	
}

?>