<div class="contentWrapper">

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
	 
	 
	// Set title, form destination
		if (isset($vars['entity'])) {
			//$title = sprintf(elgg_echo("poll:editpost"),$object->title);
			$action = "poll/edit";
			$question = $vars['entity']->question;
			$responses = $vars['entity']->responses;
			$tags = $vars['entity']->tags;
			$access_id = $vars['entity']->access_id;
            $container_guid = get_input('container_guid', $_SESSION['user']->getGUID());
            $homepage=$vars['entity']->homepage;
            $categories=$vars['entity']->categories;
		} else  {
			//$title = elgg_echo("poll:addpost");
			$action = "poll/add";
			$question = "";
			$responses = "";
			$tags = "";
			$access_id = -2;
            $container_guid = get_input('container_guid', $_SESSION['user']->getGUID());
            $homepage='';
		}

	// Just in case we have some cached details
		if (isset($vars['question'])) {
			$question = $vars['question'];
			$responses = $vars['responses'];
			$tags = $vars['polltags'];
		}
            $poll_homepage[0]='Yes';
            $poll_homepage[1]='No';
            $poll_homepage[2]='Read';
		
	//convert $responses to string for text display
		$responsestring = "";
		
		if (!empty($responses)) {
    		if (is_array($responses)) {
	  	    	foreach($responses as $response) {
	            
	  	    		if (!empty($responsestring)) {
	     				$responsestring .= ", ";
	       			}
	            	
	            	if (is_string($response)) {
	            		$responsestring .= $response;
	            	} else {
	            		$responsestring .= $response->value;
	            	}
	            
	        	}
    		} else {
    			$responsestring = $responses;
    		}
    	}


?>

<?php
        $question_label = elgg_echo('poll:question');
        $question_textbox = elgg_view('input/text', array('internalname' => 'question', 'value' => $question));
        
        $responses_label = elgg_echo('poll:responses');
        $responses_textbox = elgg_view('input/text', array('internalname' => 'responses', 'value' => $responsestring));
                
        $tag_label = elgg_echo('tags');
        $tag_input = elgg_view('input/tags', array('internalname' => 'polltags', 'value' => $tags));
                
        $access_label = elgg_echo('access');
        $access_input = elgg_view('input/access', array('internalname' => 'access_id', 'value' => $access_id));

        $container_guid_hidden = elgg_view('input/hidden', array('internalname' => 'container_guid', 'value' => $container_guid));

        if(isadminloggedin() && is_plugin_enabled('custom_index')){
            $homepage_label = elgg_echo('poll:homepage');
            $homepage_hidden=elgg_view('input/pulldown',array('internalname' => 'homepage', 'options' => $poll_homepage,'value'=>$homepage));
        }
        else   $homepage_hidden=elgg_view('input/hidden', array('internalname' => 'homepage', 'value' => 'No'));
          $categories_input = elgg_view('categories',$vars);
		  if (!empty($categories_input)) $categories_input = '<div id="blog_edit_sidebar">' . $categories_input . '</div>';
	//	$categories_input = elgg_view('categories',array('baseurl' => $CONFIG->wwwroot . 'search/?subtype=poll&tagtype=universal_categories&tag=','subtype' => 'categories'));

        $submit_input = elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('save')));

        if (isset($vars['entity'])) {
        	$entity_hidden = elgg_view('input/hidden', array('internalname' => 'pollpost', 'value' => $vars['entity']->getGUID()));
        } else {
        	$entity_hidden = '';
        }

        $form_body = <<<EOT
		
		<p>
			<label>$question_label</label><br />
                        $question_textbox
		</p>
		<p>
			<label>$responses_label</label><br />
                        $responses_textbox
		</p>
		<p>
			<label>$tag_label</label><br />
                        $tag_input
		</p>
<p>
                $categories_input
		</p>
		<p>
			<label>$access_label</label><br />
                        $access_input
		</p>
<p>
			<label>$homepage_label</label><br />
                        $homepage_hidden
		</p>
		<p>
			$entity_hidden
			$submit_input
            $container_guid_hidden
		</p>
EOT;

      echo elgg_view('input/form', array('action' => "{$vars['url']}action/$action", 'body' => $form_body));
?>
</div>

