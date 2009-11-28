<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */
	 
	
		$owner = $vars['entity']->getOwnerEntity();
		$friendlytime = friendly_time($vars['entity']->time_created);
		$responses = $vars['entity']->countAnnotations('vote');
		//
		$icon = elgg_view(
						"profile/icon", array(
										'entity' => $owner,
										'size' => 'tiny',
									  		)
						);
		$info = "<a href=\"{$vars['entity']->getURL()}\">{$vars['entity']->question}</a><br>";
		$info .= "{$responses}".elgg_echo("responses")."<br />";
		$info .= "<p class=\"owner_timestamp\"><a href=\"{$owner->getURL()}\">{$owner->name}</a> {$friendlytime}</p>";
		echo elgg_view_listing($icon,$info);//elgg_view_listing($icon,$info); elgg_echo($info);
?>