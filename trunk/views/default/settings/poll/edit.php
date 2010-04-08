<?php
/**
	 * Elgg poll plugin
	 *
	 * @package Elggpoll
	 * @author VinSoft di Erminia Naccarato
	 * @copyright VinSoft 2009
	 * @link http://vinsoft.it
	 *
	 */

?>


<p>
<br />
<h3><?php echo elgg_echo('poll:usepolladmin'); ?>: </h3>
<?php
        $defaultpolladmin = ($vars['entity']->usepolladmin) ? $vars['entity']->usepolladmin : 0;

        $defaultpolladminoption = array(
            'internalname' => 'params[usepolladmin]',
            'value' => $defaultpolladmin,
            'options_values' => array(0 => elgg_echo("poll:usepolladmin:no"),
                    1 => elgg_echo("poll:usepolladmin:yes"),
                
            )
        );

        echo elgg_view('input/pulldown', $defaultpolladminoption);
?>
</p>
<br />