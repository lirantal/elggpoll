<?php

	/**
	 * Elgg Poll plugin
	 * @package Elggpoll
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @Original author John Mellberg
	 * website http://www.syslogicinc.com
	 * @Modified By Team Webgalli to work with ElggV1.5
	 * www.webgalli.com or www.m4medicine.com
     * "Code modified by Vinsoft di Erminia Naccarato, www.vinsoft.it"
	 */
	 

	// Make sure we're logged in (send us to the front page if not)
	gatekeeper();

    // make sure action is secure
    action_gatekeeper();

	// Get input data
	$question = get_input('question');
	$responses = get_input('responses');
	$tags = get_input('polltags');
	$access = get_input('access_id');
	$pollpost = get_input('pollpost');
    $categories=get_input('universal_categories_list');
    $homepage=get_input('homepage');
		
	// Make sure we actually have permission to edit
	$poll = get_entity($pollpost);
      $container_guid=$poll->container_guid;
	
	if ($poll->getSubtype() == "poll" && $poll->canEdit()) {
	
		$_SESSION['question'] = $question;
		$_SESSION['responses'] = $responses;
		$_SESSION['polltags'] = $tags;
        $_SESSION['universal_categories_list'] = $categories;
			
		// Convert string of tags into a preformatted array
		$tagarray = string_to_tag_array($tags);
	
		
		// Make sure the title / description aren't blank
		if (empty($question) || empty($responses)) {
			register_error(elgg_echo("poll:blank"));
			forward("mod/poll/add.php");
				
		// Otherwise, save the poll post 
		} else {
				
			// Get owning user
			$owner = get_entity($poll->getOwner());
            $poll->container_guid = $container_guid;
		
			// For now, set its access to public (we'll add an access dropdown shortly)
			$poll->access_id = $access;
		
			// Set its title and description appropriately
			$poll->question = $question;
			$poll->title = $question;
            $poll->categories=$categories;
            $poll->homepage=$homepage;
			// Before we can set metadata, we need to save the poll post
			if (!$poll->save()) {
				register_error(elgg_echo("poll:error"));
				forward("mod/poll/edit.php?pollpost=" . $guid);
			}
		// Add to river
	        add_to_river('river/object/poll/update','update',$_SESSION['user']->guid,$poll->guid);
			
			//add the new responses
			$poll->clearMetadata('responses');
			
			$poll->responses = $responses;
		
			// Now let's add tags. We can pass an array directly to the object property! Easy.
			$poll->clearMetadata('tags');
			
			if (is_array($tagarray)) {
				$poll->tags = $tagarray;
			}
			
            $defaultpolladmin = intval(get_plugin_setting('usepolladmin', 'poll'));
        if($defaultpolladmin == 1){

	    disable_entity($poll->guid);
		system_message(sprintf(elgg_echo("poll:saved:request"),$poll->question));
        }
		
			// Success message
			system_message(elgg_echo("poll:posted"));
			
			
			// Remove the poll post cache
			unset($_SESSION['question']); 
			unset($_SESSION['responses']); 
			unset($_SESSION['polltags']);

            if($defaultpolladmin == 0)
    system_message(sprintf(elgg_echo("poll:saved"),$poll->question));

	forward("pg/poll/group:". $container_guid);
}
    }
		

?>
