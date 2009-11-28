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
		
		/**/
		$icon = elgg_view(
				"profile/icon", array(
										'entity' => $owner,
										'size' => 'small',
									  )
			);
		
		
		$info = "<p>" . elgg_echo('poll') . ": <a href=\"{$vars['entity']->getURL()}\">{$vars['entity']->question}</a></p>";
		$info .= "<p>{$responses} ".elgg_echo("responses")."</p>";
		$info .= "<p><a href=\"{$owner->getURL()}\">{$owner->name}</a> {$friendlytime}</p>";

		//display
		echo "<div class=\"poll_gallery\">";
		echo "<div class=\"poll_gallery_icon\">" . $icon . "</div>";
		echo "<div class=\"poll_gallery_content\">" . $info . "</div>";
		echo "</div>";


?>