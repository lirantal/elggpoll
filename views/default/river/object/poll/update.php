<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */
 
	$performed_by = get_entity($vars['item']->subject_guid); // $statement->getSubject();
	$object = get_entity($vars['item']->object_guid);
	$containerEntity = get_entity($object->container_guid);
	$poll_group_info = "";
	if ($containerEntity instanceof ElggGroup) {
		$poll_url = $CONFIG->wwwroot."pg/poll/".$containerEntity->username."/read/".$object->guid;
		$poll_group_info = " " . elgg_echo('groups:ingroup') . " <a href='".$containerEntity->getURL()."' >" . $containerEntity->name  . "</a>";
	} else
		$poll_url = $object->getURL();
	
	$url = "<a href=\"{$performed_by->getURL()}\">{$performed_by->name}</a>";
	$string = sprintf(elgg_echo("poll:river:updated"),$url) . " ";
    $string .= elgg_echo("poll:river:update") . " <a href='$poll_url' >" . $object->question . "</a>";
	$string .= $poll_group_info;
    	
?>

<?php echo $string; ?>