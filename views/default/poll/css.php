<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */
	 

?>

.singleview {
	margin-top:10px;
}

.poll_post_icon {
	float:left;
	margin:-5px 0 0 0;
	padding:0;
}

.poll_post h3 {
	font-size: 150%;
	margin:0 0 10px 0;
	padding:0;
}

.poll_post h3 a {
	text-decoration: none;
}

.poll_post p {
	margin: 0 0 5px 0;
}
.poll_post .strapline {
	margin: 0 0 0 35px;
	padding:0;
	color: #aaa;
	line-height:1em;
}
.poll_post p.tags {
	background:transparent url(<?php echo $vars['url']; ?>_graphics/icon_tag.gif) no-repeat scroll left 2px;
	margin:0 0 7px 35px;
	padding:0pt 0pt 0pt 16px;
	min-height:22px;
}
.poll_edit_link {
	float:right;
	margin:5px 5px 5px 50px;
}
.poll_edit_link a {
	padding:2px 25px 5px 0;
	display:block;
}
.poll_edit_link a:hover {
	background-position: right -40px;
}


div.poll_fields  {
	text-align: right;
	direction:rtl;
}

.input-radio {
	border:none;
	text-align:left;
	vertical-align:top;
}

/*
#progress_indicator {
	width:400px;
	padding: 10px;
}
	
#progressBarContainer {
	height:12px;
	width:100%;
	border: 1px #D9541E solid;
}
*/

#progress_indicator {
	width: 550px;
	height: 20px;
	/* background-color:	rgb(146, 183, 211); */
	background-color: #AFC7C7;
}
	
#progressBarContainer {
	border-right: 1px solid white;
	width: 50%;
	height: 20px;
	background-color: rgb(91, 147, 191);
}

#progressBarContainerText {
	text-align: left;
	margin-top: -20px;
	color: white;
	padding-left: 4px;
	margin-right: 6px;
}

#progressBarContainerPercent {
	text-align: right;
	margin-top: -18px;
	color: white;
	padding-right: 6px;
}


/* ***************************************
	RIVER
*************************************** */

.river_object_poll_create {
	background: url(<?php echo $vars['url']; ?>mod/poll/graphics/river_icon_poll.gif) no-repeat left -1px;
}
.river_object_poll_update {
	background: url(<?php echo $vars['url']; ?>mod/poll/graphics/river_icon_poll.gif) no-repeat left -1px;
}
.river_object_poll_comment {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_poll_vote {
	background: url(<?php echo $vars['url']; ?>mod/poll/graphics/river_icon_vote.gif) no-repeat left -1px;
}
