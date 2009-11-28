<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */


	/**
	 * poll initialisation
	 *
	 * These parameters are required for the event API, but we won't use them:
	 * 
	 * @param unknown_type $event
	 * @param unknown_type $object_type
	 * @param unknown_type $object
	 */

		function poll_init() {
			
			// Load system configuration
				global $CONFIG;
				
			// Load the language file
				register_translations($CONFIG->pluginspath . "poll/languages/");
				
			// Set up menu for logged in users
				if (isloggedin()) {
    				
					add_menu(elgg_echo('polls'), $CONFIG->wwwroot . "pg/poll/" . $_SESSION['user']->username);
					
			// And for logged out users
				} else {
					add_menu(elgg_echo('poll'), $CONFIG->wwwroot . "mod/poll/everyone.php",array(
					));
				}
				
			// Extend system CSS with our own styles, which are defined in the poll/css view
				extend_view('css','poll/css');
                extend_view('categories/list','poll/categorylist');
				
			// Extend hover-over menu	
				extend_view('profile/menu/links','poll/menu');
				
			// Register a page handler, so we can have nice URLs
				register_page_handler('poll','poll_page_handler');
				
			// Register a URL handler for poll posts
				register_entity_url_handler('poll_url','object','poll');
								
			// Register entity type
				register_entity_type('object','poll');
				
			//add widget
				add_widget_type('poll',sprintf(elgg_echo("poll:mypolls")),sprintf(elgg_echo('poll:displayyourpoll')));
			add_widget_type('latestPolls',sprintf(elgg_echo('poll:latestComunityPoll')),sprintf(elgg_echo('poll:displaymostrecentpoll')));


		}

        // Add option to allow or not the use of poll for a group
		if (function_exists('add_group_tool_option')) {
			$poll_default = get_plugin_setting('group_default', 'poll');
			if (!$poll_default || ($poll_default == 'yes')) {
				add_group_tool_option('poll',elgg_echo('poll:enable_group_polls'),true);
			} else {
				add_group_tool_option('poll',elgg_echo('poll:enable_group_polls'),false);
			}
		}
		
		function poll_pagesetup() {
			
			global $CONFIG;
            $page_owner = page_owner_entity();

		$context = get_context();
        // Group submenu option
        //add submenu options for a group
		if ($page_owner instanceof ElggGroup && $context == 'groups') {
			$group_poll = get_plugin_setting('group_poll', 'poll');
			if (!$group_poll || $group_poll != 'no') {
				if (!$page_owner->poll_enable || $page_owner->poll_enable != 'no') {
					//add_submenu_item(elgg_echo("poll:group"), $CONFIG->wwwroot . "pg/poll/group:" . $page_owner->getGUID());
					add_submenu_item(elgg_echo("poll:group"), $CONFIG->wwwroot . "pg/poll/" . $page_owner->username);
				}
			}

		}

			//add submenu options
			/*
				if (get_context() == "poll") {
					if ((page_owner() == $_SESSION['guid']) || (!page_owner() && isloggedin()) ) {
						add_submenu_item(elgg_echo('poll:your'),$CONFIG->wwwroot."pg/poll/" . $_SESSION['user']->username);
						add_submenu_item(elgg_echo('poll:friends'),$CONFIG->wwwroot."pg/poll/" . $_SESSION['user']->username . "/friends/");
						add_submenu_item(elgg_echo('poll:everyone'),$CONFIG->wwwroot."pg/poll/" . $_SESSION['user']->username . "/everyone");
						add_submenu_item(elgg_echo('poll:addpost'),$CONFIG->wwwroot."pg/poll/" . $_SESSION['user']->username . "/add");
					} else if (page_owner()) {
						$page_owner = page_owner_entity();
						add_submenu_item(sprintf(elgg_echo('poll:user'),$page_owner->name),$CONFIG->wwwroot."pg/poll/" . $page_owner->username);
						if ($page_owner instanceof ElggUser) // Sorry groups, this isn't for you.
							add_submenu_item(sprintf(elgg_echo('poll:user:friends'),$page_owner->name),$CONFIG->wwwroot."pg/poll/" . $page_owner->username . "/friends/");
						add_submenu_item(elgg_echo('poll:everyone'),$CONFIG->wwwroot."pg/poll/" . $_SESSION['user']->username . "/everyone");
					} else {
						add_submenu_item(elgg_echo('poll:everyone'),$CONFIG->wwwroot."pg/poll/" . $_SESSION['user']->username . "/everyone");
					}
				}
			*/

                //add submenu options
				if (get_context() == "poll2") {
                    //$page_owner = page_owner_entity();
					if (($page_owner->getGUID() == $_SESSION['user']->guid) || (!page_owner() && isloggedin()) ) {
						add_submenu_item(elgg_echo('poll:your'),$CONFIG->wwwroot."pg/poll/" . $page_owner->username);
						add_submenu_item(elgg_echo('poll:friends'),$CONFIG->wwwroot."pg/poll/" . $page_owner->username . "/friends/");
						add_submenu_item(elgg_echo('poll:everyone'),$CONFIG->wwwroot."pg/poll/" . $page_owner->username . "/everyone");
						add_submenu_item(elgg_echo('poll:addpost'),$CONFIG->wwwroot."pg/poll/" . $page_owner->username . "/add");

					} else if ( ($page_owner instanceof ElggUser) && ($page_owner->getGUID() != $_SESSION['user']->guid) ) {
						add_submenu_item($page_owner->name . "'s ". elgg_echo('polls'), $CONFIG->wwwroot."pg/poll/" . $page_owner->username);
						add_submenu_item(elgg_echo('poll:everyone'),$CONFIG->wwwroot."pg/poll/" . $page_owner->username . "/everyone");
					}
					

					if ($page_owner instanceof ElggGroup ) {
						//$page_owner = page_owner_entity();
	
						add_submenu_item(sprintf(elgg_echo('poll:user'),$page_owner->name),$CONFIG->wwwroot."pg/poll/" . $page_owner->username,'0pollmanage');
					   if($page_owner->isMember($_SESSION['user']))
						   add_submenu_item(elgg_echo('poll:addpost'),$CONFIG->wwwroot."pg/poll/" . $page_owner->username . "/add/".$page_owner->getGUID());						   
					}
                }

          
            $defaultpolladmin = intval(get_plugin_setting('usepolladmin', 'poll'));
            //print($defaultpolladmin);

            if($defaultpolladmin == 1)
            if (get_context () == 'admin' && isadminloggedin ()) {
                    global $CONFIG;
                    add_submenu_item ( elgg_echo ( 'poll:approvelist' ), $CONFIG->wwwroot . 'mod/poll/approvelist.php' );
                    //add_submenu_item ( elgg_echo ( 'defaultwidgets:menu:dashboard' ), $CONFIG->wwwroot . 'pg/defaultwidgets/dashboard' );
                }

			
		}
		
		/**
		 * poll page handler; allows the use of fancy URLs
		 *
		 * @param array $page From the page_handler function
		 * @return true|false Depending on success
		 */
		function poll_page_handler($page) {
			
			// The first component of a poll URL is the username
			if (isset($page[0])) {
				set_input('username',$page[0]);
			}
			
			// The second part dictates what we're doing
			if (isset($page[1])) {
				switch($page[1]) {
					case "add":		
								set_input('container_guid',$page[2]);
								@include(dirname(__FILE__) . "/add.php");
								break;
					case "read":		
								set_input('pollpost',$page[2]);
								@include(dirname(__FILE__) . "/read.php");
								break;
					case "everyone":		
								//set_input('pollpost',$page[2]);
								@include(dirname(__FILE__) . "/everyone.php");
								break;
					case "edit":		
								set_input('pollpost',$page[2]);
								@include(dirname(__FILE__) . "/edit.php");
								break;
					case "friends":		@include(dirname(__FILE__) . "/friends.php");
										break;
				}
			// If the URL is just 'poll/username', or just 'poll/', load the standard poll index
			} else {
				@include(dirname(__FILE__) . "/index.php");
				return true;
			}
			
			return false;
			
		}

		/**
		 * Populates the ->getUrl() method for poll objects
		 *
		 * @param ElggEntity $pollpost poll post entity
		 * @return string poll post URL
		 */
		function poll_url($pollpost) {
			
			global $CONFIG;
			$title = $pollpost->title;
			$title = friendly_title($title);
			return $CONFIG->url . "pg/poll/" . $pollpost->getOwnerEntity()->username . "/read/" . $pollpost->getGUID() . "/" . $title;
			
		}
		
		
		/*
		checks for votes on the poll
		@param ElggEntity $poll
		@param guid
		@return true/false
		*/
		function checkForPreviousVote($poll, $user_guid)
		{
			$votes = $poll->getAnnotations('vote',9999,0,'desc');
			
			if(count($votes) > 0)
			{
				foreach($votes as $vote)
				{
					if($vote->owner_guid == $user_guid) return true;
				}
				return false;
			}
			return true;
		}

        //Create function for the entity that are disabled
        function poll_get_disabled_entities($type = "", $subtype = "", $owner_guid = 0, $order_by = "", $limit = 10, $offset = 0, $count = false, $site_guid = 0, $container_guid = null, $enabled = false)
        {
		global $CONFIG;

		if ($subtype === false || $subtype === null || $subtype === 0)
			return false;

		if ($order_by == "") $order_by = "time_created desc";
		$order_by = sanitise_string($order_by);
		$limit = (int)$limit;
		$offset = (int)$offset;
		$site_guid = (int) $site_guid;
		if ($site_guid == 0)
			$site_guid = $CONFIG->site_guid;

		$where = array();

		if (is_array($type)) {
			$tempwhere = "";
			if (sizeof($type))
			foreach($type as $typekey => $subtypearray) {
				foreach($subtypearray as $subtypeval) {
					$typekey = sanitise_string($typekey);
					if (!empty($subtypeval)) {
						$subtypeval = (int) get_subtype_id($typekey, $subtypeval);
					} else {
						$subtypeval = 0;
					}
					if (!empty($tempwhere)) $tempwhere .= " or ";
					$tempwhere .= "(type = '{$typekey}' and subtype = {$subtypeval})";
				}
			}
			if (!empty($tempwhere)) $where[] = "({$tempwhere})";

		} else {

			$type = sanitise_string($type);
			$subtype = get_subtype_id($type, $subtype);

			if ($type != "")
				$where[] = "type='$type'";
			if ($subtype!=="")
				$where[] = "subtype=$subtype";

		}

		if ($owner_guid != "") {
			if (!is_array($owner_guid)) {
				$owner_array = array($owner_guid);
				$owner_guid = (int) $owner_guid;
			//	$where[] = "owner_guid = '$owner_guid'";
			} else if (sizeof($owner_guid) > 0) {
				$owner_array = array_map('sanitise_int', $owner_guid);
				// Cast every element to the owner_guid array to int
			//	$owner_guid = array_map("sanitise_int", $owner_guid);
			//	$owner_guid = implode(",",$owner_guid);
			//	$where[] = "owner_guid in ({$owner_guid})";
			}
			if (is_null($container_guid)) {
				$container_guid = $owner_array;
			}
		}
		if ($site_guid > 0)
			$where[] = "site_guid = {$site_guid}";

		if (!is_null($container_guid)) {
			if (is_array($container_guid)) {
				foreach($container_guid as $key => $val) $container_guid[$key] = (int) $val;
				$where[] = "container_guid in (" . implode(",",$container_guid) . ")";
			} else {
				$container_guid = (int) $container_guid;
				$where[] = "container_guid = {$container_guid}";
			}
		}

		if($enabled == false)
		{
			$where[] = "enabled = 'no'";
		}
		if (!$count) {
			$query = "SELECT * from {$CONFIG->dbprefix}entities where ";
		} else {
			$query = "SELECT count(guid) as total from {$CONFIG->dbprefix}entities where ";
		}
		foreach ($where as $w)
			$query .= " $w and ";
		$query .= get_access_sql_suffix(); // Add access controls
		if (!$count) {
			$query .= " order by $order_by";
			if ($limit) $query .= " limit $offset, $limit"; // Add order and limit

			//echo $query;
			$dt = get_data($query, "entity_row_to_elggstar");
			return $dt;
		} else {
			$total = get_data_row($query);
			//echo $query;
			return $total->total;
		}
	}
		
				
	// Make sure the poll initialisation function is called on initialisation
		register_elgg_event_handler('init','system','poll_init');
		register_elgg_event_handler('pagesetup','system','poll_pagesetup');
		
	// Register actions
		global $CONFIG;
		register_action("poll/add",false,$CONFIG->pluginspath . "poll/actions/add.php");
		register_action("poll/edit",false,$CONFIG->pluginspath . "poll/actions/edit.php");
		register_action("poll/delete",false,$CONFIG->pluginspath . "poll/actions/delete.php");
		register_action("poll/vote",false,$CONFIG->pluginspath . "poll/actions/vote.php");
		register_action("poll/approve",false,$CONFIG->pluginspath . "poll/actions/approve.php", true);
?>