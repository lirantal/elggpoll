<?php
/**
 * Elgg Poll plugin
 * @package poll
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author	Liran Tal
 * Code modified by 
 * Team Webgalli, Vinsoft di Erminia Naccarato, www.vinsoft.it
 */
	 

	if (isset($vars['entity'])) {
				
		
		//set img src
		$img_src = $vars['url'] . "mod/poll/graphics/poll.gif";
		
		$question = $vars['entity']->question;
		
		//get the array of possible responses
		$responses = $vars['entity']->responses;
		
		//get the array of user responses to the poll
		$user_responses = $vars['entity']->getAnnotations('vote',9999,0,'desc');
		
		//get the count of responses
		$user_responses_count = $vars['entity']->countAnnotations('vote');
		
?>
		
		<h3><?php echo elgg_echo('poll:results') ?></h3>
		
		<?php
		//populate array
		foreach($responses as $response)
		{
			//get count per response
			$response_count = getResponseCount($response, $user_responses);
			
			//calculate %
			$response_percentage = round(100 / ($user_responses_count / $response_count))
			
			?>
			<div id="progress_indicator" >
			
				<div id="progressBarContainer" style="width: <?=$response_percentage?>%;" ></div>
				<div id="progressBarContainerText" >
					</div>
				<div id="progressBarContainerPercent" >
					<?=$response_percentage?>%
					</div>
				
			</div>
			<?=$response?>
			<br/>
			<br/>
		<?php
		}
		?>
		
		<p>
			<?php echo elgg_echo('poll:totalvotes') . $user_responses_count; ?>
		</p>
		
	<?php
		
	}
	else
	{
		register_error(elgg_echo("poll:blank"));
		forward("mod/poll/index.php");
	}
	
	function getResponseCount($valueToCount, $fromArray)
	{
		$count = 0;
		
		if(is_array($fromArray))
		{
			foreach($fromArray as $item)
			{
				if($item->value == $valueToCount)
				{
					$count += 1;
				}
			}	
		}
		
		return $count;
	}
?>
