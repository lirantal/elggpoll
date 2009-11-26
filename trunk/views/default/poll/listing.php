<?php

    /**
     * Elgg poll listing
     *
     * @package Elggpoll
     * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
     * @author John Mellberg
     * @copyright John Mellberg 2009
     * "Code modified by Vinsoft di Erminia Naccarato, www.vinsoft.it"
     */
$poll=$vars['entity'];
$defaultpolladmin = intval(get_plugin_setting('usepolladmin', 'poll'));
$url_server=$_SERVER["PHP_SELF"];
//print($url_server);

$owner = $vars['entity']->getOwnerEntity();
$friendlytime = friendly_time($vars['entity']->time_created);
$responses = $vars['entity']->countAnnotations('vote');
//$icon = "";
        /**/
$icon = elgg_view(
                "profile/icon", array(
                                        'entity' => $owner,
                                        'size' => 'small',
    )
);

if(isadminloggedin() && get_context () == 'admin'&& !strstr($url_server,"approvePoll") ){
    $pollenable=sprintf(elgg_echo('poll:enable:on'));
    $info .="<p>" . elgg_echo('poll') . ": ".$vars['entity']->question."</p>";
    if($defaultpolladmin == 1)
    $info .="<a href=\"".$CONFIG->wwwroot."action/poll/approve?pollpost=".$poll->guid."\">$pollenable</a>";
}else {$info .= "<p>" . elgg_echo('poll') . ": <a href=\"".$CONFIG->wwwroot."mod/poll/read.php?pollpost=".$vars['entity']->guid."\">{$vars['entity']->question}</a></p>";
}


//$info = "<p>" . elgg_echo('poll') . ": <a href=\"{$vars['entity']->getURL()}\">{$vars['entity']->question}</a></p>";
$info .= "<p>{$responses} ".elgg_echo("responses")."</p>";
$info .= "<p class=\"owner_timestamp\"><a href=\"{$owner->getURL()}\">{$owner->name}</a> {$friendlytime}</p>";
echo elgg_view_listing($icon,$info);

?>