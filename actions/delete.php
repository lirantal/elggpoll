<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */


	// Make sure we're logged in (send us to the front page if not)
	gatekeeper();
	
	// Get input data
	$guid = (int) get_input('pollpost');
	
	// Make sure we actually have permission to edit
	$poll = get_entity($guid);
	if ($poll->getSubtype() == "poll" && $poll->canEdit()) {
	
		// Get owning user
		$owner = get_entity($poll->getOwner());
		$containerEntity = get_entity($poll->container_guid);
		if ($containerEntity instanceof ElggGroup)
			$owner = $containerEntity;
		
		// Delete it!
		$rowsaffected = $poll->delete();
		if ($rowsaffected > 0) {
			// Success message
			system_message(elgg_echo("poll:deleted"));
		} else {
			register_error(elgg_echo("poll:notdeleted"));
		}
		// Forward to the main poll page
		forward("pg/poll/".$owner->username);
	
	}

?>