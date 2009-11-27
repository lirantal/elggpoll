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
			$tags = "";
			$access_id = -2;
            $container_guid = get_input('container_guid', $_SESSION['user']->getGUID());
            $homepage='';
		}

		// Just in case we have some cached details
		if (isset($vars['question'])) {
			$question = $vars['question'];
			$tags = $vars['polltags'];
		}
            $poll_homepage[0]='Yes';
            $poll_homepage[1]='No';
            $poll_homepage[2]='Read';
		
?>

<?php

		$lang_response = elgg_echo('poll:response');
		$lang_remove = elgg_echo('remove');
		$lang_pollresponses = elgg_echo('poll:responses');
		$lang_addresponses = elgg_echo('poll:add_response');
		
        $question_label = elgg_echo('poll:question');
        $question_textbox = elgg_view('input/text', array('internalname' => 'question', 'value' => $question));
		
		
		// if no responses are available yet meaning this is a new poll
		// then we add 4 empty responses by default
		if (count($responses) == 0)
			$responses = array("", "", "", "");
		
		$form_fields = "";
		$i = 100;
		foreach ($responses as $response) {
			$form_fields .= "<p id='fieldid_$i'>";
			$form_fields .= "<input  type='text' name='responses[]' size='60' value='$response' /> ";
			$form_fields .= "<a href='#' onClick='poll_removeFormInputField(\"#fieldid_$i\"); return false;'>$lang_remove</a>";
			$form_fields .= "<br/>";
			$form_fields .= "</p>";
			$i++;
		}
		
		
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

		<br/>
		<p>
			<label>$lang_pollresponses</label><br/>
			$form_fields
			<input type="hidden" id="idCounter" value="1">
			<div id="div_poll_fields" class="poll_fields"></div>
		
		</p>
		<p><a href="#" onClick="poll_addFormInputField(); return false;">Add</a></p>
		<br/>
		
		
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
		
		
		
		<script type="text/javascript">

			function poll_addFormInputField() {
			
				var id = document.getElementById("idCounter").value;
				$("#div_poll_fields").append("<p id='row" + id + "'><label for='txt" + id + "'> <input type='text' size='60' name='responses[]' id='txt" + id + "'> <a href='#' onClick='poll_removeFormInputField(\"#row" + id + "\"); return false;'>$lang_remove</a><p>");
				
				id = (id-1)+2;
				document.getElementById("idCounter").value = id;
				
			}
			
			function poll_removeFormInputField(id) {
				$(id).remove();
			}
			
		</script>
		
		<p>
			$entity_hidden
			$submit_input
            $container_guid_hidden
		</p>
EOT;

      echo elgg_view('input/form', array('action' => "{$vars['url']}action/$action", 'body' => $form_body));
?>
</div>

