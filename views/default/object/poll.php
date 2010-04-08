<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */
	 

	 $user = get_input("username", $_SESSION['user']->username);
	 
	 $owner = $vars['entity']->getOwnerEntity();
	 
	if (isset($vars['entity'])) {
			
		if (get_context() == "search"||get_context() == "admin") {
				
			//display the correct layout depending on gallery or list view
			if (get_input('search_viewtype') == "gallery") {

				//display the gallery view
            	echo elgg_view("poll/gallery",$vars);

			} else {
				
				echo elgg_view("poll/listing",$vars);

			}

		} else {
			
	?>
		<!-- patches by webgalli -->
	<div class="contentWrapper singleview">
		<div class="poll_edit_link">
				<!-- display edit options if it is the poll post owner -->
		<?php
		if ($vars['entity']->canEdit()) {
		?>
			<a href="<?php echo $vars['url']; ?>pg/poll/<?=$user?>/edit/<?php echo $vars['entity']->getGUID(); ?>"><?php echo elgg_echo("edit"); ?></a>
			<?php
					
					echo elgg_view("output/confirmlink", array(
									'href' => $vars['url'] . "action/poll/delete?pollpost=" . $vars['entity']->getGUID(),
									'text' => elgg_echo('delete'),
									'confirm' => elgg_echo('deleteconfirm'),
									));
	
					// Allow the menu to be extended
					echo elgg_view("editmenu",array('entity' => $vars['entity']));
					
				}
			
			?>
		</div>
	<div class="poll_post">
		<h3><a href="<?php echo $url; ?>"><?php echo $vars['entity']->title; ?></a></h3>
		<!-- display the user icon -->
		<div class="poll_post_icon">
		    <?php
		        echo elgg_view("profile/icon",array('entity' => $owner, 'size' => 'tiny'));
			?>
	    </div>
			<p class="strapline">
				<?php echo sprintf(elgg_echo("poll:strapline"), date("F j, Y",$vars['entity']->time_created)); ?>
				<?php echo elgg_echo('by'); ?> <a href="<?php echo $vars['url']; ?>pg/ad/<?php echo $owner->username; ?>"><?php echo $owner->name; ?></a> 
				<!-- display the comments link -->
				<?php
			    //get the number of responses
				$num_responses = $vars['entity']->countAnnotations('vote');
				//get the number of comments
				$num_comments = elgg_count_comments($vars['entity']);
			    ?>
			    <?php //echo "(" . $num_responses . " " . sprintf(elgg_echo("poll:responses_")) . ")"; ?>
			<a href="<?php echo $vars['entity']->getURL(); ?>"><?php echo sprintf(elgg_echo("comments")) . " (" . $num_comments . ")"; ?></a><br />
			</p>
			<!-- display tags -->
				<?php
	
					$tags = elgg_view('output/tags', array('tags' => $vars['entity']->tags));
					if (!empty($tags)) {
						echo '<p class="tags">' . $tags . '</p>';
					}
				?>
			</div></div>
			<!-- patches by webgalli -->

	<div class="poll_post">
		<div class="poll_post_body">

			<!-- display the actual poll post -->
	<div class="contentWrapper">
			<?php
				
				$isPgOwner = ($owner->guid == $vars['user']->guid);
				$priorVote = checkForPreviousVote($vars['entity'], $vars['user']->guid);
				
		$alreadyVoted = 0;
        if ( $priorVote !== false ) {
          $alreadyVoted = 1;
        }
				
				//if user has voted, show the results
				if ( $alreadyVoted ) {
          // show the user's vote
					echo "<p><h2>" . elgg_echo('poll:voted') . "</h2></p>";
				} else {
					
					//else show the voting form
					echo elgg_view('poll/forms/vote', array('entity' => $vars['entity']));
					
				}
			?>
		
		</div>
		</div>
		<div class="clearfloat"></div>
			
		<div id="resultsDiv" class="contentWrapper" style="display:block;">
			<?php echo elgg_view('poll/results',array('entity' => $vars['entity'])); ?>
		</div>

		<div class="clearfloat"></div>


	</div>
	
<?php

			// If we've been asked to display the full view
			if (isset($vars['full']) && $vars['full'] == true) {
				echo elgg_view_comments($vars['entity']);
			}
				
		}

	}
?>