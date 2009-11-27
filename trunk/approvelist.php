<?php
	/**
	 * Elgg poll plugin
	 *
	 * @package Elggpoll
	 * @author VinSoft di Erminia Naccarato
	 * @copyright VinSoft 2009
	 * @link http://vinsoft.it
	 *
	 */
//create the list of polls that the admin can enabled

	require_once(dirname(dirname(dirname(__FILE__))) . '/engine/start.php');
		admin_gatekeeper();

	// Set context

		set_context("admin");

	// Get site and adcategories

	
	$limit = get_input("limit", 10);
	$offset = get_input("offset", 0);
	$tag = get_input("tag");
	access_show_hidden_entities(true);
	
	
	// Get objects
	$context = get_context();
	
	//set_context('search');
	$entities1=poll_get_disabled_entities('object',"poll", 0, $limit, true, true, true);
    

/*	if ($tag != "")
		$objects = list_entities_from_metadata('tags',$tag,'group',"","", $limit, false);
	else
		$objects = list_entities('group',"", 0, $limit, true, true, true);*/
//===================
	$offset = (int) get_input('offset');
	$count = poll_get_disabled_entities('object', "poll", 0, "", $limit, $offset, true);
	$entities = poll_get_disabled_entities('object', "poll", 0, "", $limit, $offset);
	$objects = elgg_view_entity_list($entities, $count, $offset, $limit, true, false, true);

//=====================		
		
	set_context($context);
	
	$title = sprintf(elgg_echo("poll:requests"),page_owner_entity()->name);
	$area2 = elgg_view_title($title);
	$area2 .= $objects;
	
	$body = elgg_view_layout('two_column_left_sidebar',$area1, $area2);
	
	// Finally draw the page
	page_draw($title, $body);



?>