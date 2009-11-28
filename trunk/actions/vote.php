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

    // make sure action is secure
    action_gatekeeper();

	// Get input data
	$response = get_input('response');
	$pollpost = get_input('pollpost');
	$access = 2;
	
	//get the poll entity
	$poll = get_entity($pollpost);
	if ($poll->getSubtype() == "poll") {
		
		$_SESSION['response'] = $response;
			
		// Make sure the response isn't blank
		if (empty($response)) {
			register_error(elgg_echo("poll:blank"));
			forward("mod/poll/add.php");
				
		// Otherwise, save the poll post 
		} else {
				
			// Get owning user
			$owner = get_entity($poll->getOwner());
				
			//add vote as an annotation
			$poll->annotate('vote', $response, $poll->access_id);
				
			// Success message
			system_message(elgg_echo("poll:responded"));
			// Add to river
	        add_to_river('river/object/poll/vote','vote',$_SESSION['user']->guid,$poll->guid);
				
			// Remove the poll post cache
			unset($_SESSION['response']);
			
			//set session variable
			$_SESSION['hasVoted'] = $poll->guid;
	
			// Forward to the poll page
			//forward("pg/poll/" . $owner . "/read/" . $poll->id . "/" . $poll->question);
			forward($_SERVER['HTTP_REFERER']);
								
		}
			
	}
?>