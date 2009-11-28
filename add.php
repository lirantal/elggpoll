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
		gatekeeper();
		
		
	
	// Get the current page's owner
		$page_owner = page_owner_entity();
		
		set_context('poll2');
		
		if ($page_owner === false || is_null($page_owner)) {
			$page_owner = $_SESSION['user'];
			set_page_owner($_SESSION['guid']);
		}
	
		
	//set the title
		$area2 = elgg_view_title(elgg_echo('poll:addpost'));

	// Get the form
		$area2 .= elgg_view("poll/forms/edit");
		
	// Display page
		page_draw(elgg_echo('poll:addpost'),elgg_view_layout("two_column_left_sidebar", $area1, $area2));

		
?>