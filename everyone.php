<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */
	 


	// Load Elgg engine
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
// Get the current page's owner
		$page_owner = page_owner_entity();
		if ($page_owner === false || is_null($page_owner)) {
			$page_owner = $_SESSION['user'];
			set_page_owner($_SESSION['guid']);
		}
        set_context("poll2");
		
		$offset = get_input('offset');
		
		if (empty($offset)) {
			$offset = 0;
		}
		
		$limit = 10;
			
		$area2 = elgg_view_title(elgg_echo('poll:everyone'));

		$polls = get_entities('object','poll',0,'time_created desc',$limit,$offset,false,0);
		
		$count = get_entities('object','poll',0,'time_created desc',999,0,true);
		
		
		set_context('search');
		
		$area2 .= elgg_view_entity_list($polls,$count,$offset,$limit,false,false,true);
		
		$body = elgg_view_layout("two_column_left_sidebar", '', $area1 . $area2);
		
	// Display page
		page_draw(elgg_echo('poll:everyone'),$body);
		
?>