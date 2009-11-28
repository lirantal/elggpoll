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
        set_context('poll2');

	//set poll title
		if ($page_owner == $_SESSION['user']){
			$area2 = elgg_view_title(elgg_echo('poll:your'));
		} else {
			$area2 = elgg_view_title($page_owner->name. "'s ". elgg_echo('polls'));
		}
		
		
		/*
		elseif(!$page_owner instanceof ElggGroup){
			$area1 = elgg_view_title(elgg_echo('poll:polls').$page_owner->username );
		}//else{$area1 =elgg_view_title(elgg_echo('poll')." ".$page_owner->name );}
		*/
		
	// Get a poll posts
		$polls = $page_owner->getObjects('poll',50,0);
		
		foreach($polls as $poll)
		{
			//$area2 .= elgg_echo($poll->question);
			$area2 .= elgg_view("poll/listing", array('entity' => $poll));
		}

        //add category list menu
global $CONFIG;

$area1 .=elgg_view('categories/list',array('baseurl' => $CONFIG->wwwroot . 'search/?subtype=poll&tagtype=universal_categories&tag='));


		
	// Display them in the page
        $body = elgg_view_layout("two_column_left_sidebar", '', $area2, $area1);
		
	// Display page
		page_draw(sprintf(elgg_echo('poll:user'),$page_owner->name),$body);
		
?>