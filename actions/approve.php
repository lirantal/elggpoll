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

	// Get input data
         $guid=get_input('pollpost');
	
				$enabled = enable_entity($guid);
                $poll=get_entity($guid);
				if ($enabled) {
		// Success message
					system_message(elgg_echo("poll:enabled"));
                    
				} else {
					register_error(elgg_echo("poll:notenabled"));
				}
		// Forward to the main blog page
				forward("pg/poll/group:". $poll->container_guid);
		
?>