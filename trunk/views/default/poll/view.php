<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */
	 

	// If there are any posts to view, view them
		if (is_array($vars['posts']) && sizeof($vars['posts']) > 0) {
			
			foreach($vars['posts'] as $post) {
				
				echo elgg_view_entity($post);
				
			}
			
		}

?>