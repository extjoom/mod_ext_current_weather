<?php
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2014 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 20/09/2014 - 13:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

// del .gif
$text_pict = $xml->current->pict;
$fragment_text_pict = strpos($text_pict, ".");
$text_pict = ( $fragment_text_pict > 1 ) ? substr($text_pict, 0, $fragment_text_pict) : $text_pict;

if (!$xml->current->t) $ext_error .= '<br><p>There is no data for this city!</p>';
?>



<div class="mod_ext_current_weather <?php echo $moduleclass_sfx ?>">
	<div class="mod_ext_current_weather_wrap">			
		<?php
		if ($ext_error == '') {	
		?>		
			<table class="ext-weather" cellspacing="0">
				<tbody>
					<tr>
					
					<?php if ($ext_show_t) : ?>
						<td class="ext_t">
							<span>
								<?php echo $xml->current->t; ?><span class="unit"> &deg;C</span>
							</span>
						</td>
					<?php endif;?>
					
					<?php if ($ext_show_img) : ?>
						<td class="ext_i">
							<img src="<?php echo JUri::root(); ?>/modules/mod_ext_current_weather/assets/images/<?php echo $text_pict; ?>.gif">						
						</td>
					<?php endif;?>
					
					<?php if ($ext_show_cloud OR $ext_show_w OR $ext_show_h OR $ext_show_p) : ?>
						<td class="ext_f">						
							<?php if ($ext_show_cloud) : ?>
								<div><?php echo $cloud_text; ?></div>
							<?php endif;?>
							
							<?php if ($ext_show_w) : ?>
								<div><?php echo JText::_(WIND);?>: <?php echo $wind_direction; ?>, <?php echo $xml->current->w; ?> <?php echo JText::_(MS);?></div>
							<?php endif;?>
							
							<?php if ($ext_show_h) : ?>
								<div><?php echo JText::_(HUMIDITY);?>: <?php echo $xml->current->h; ?>%</div>
							<?php endif;?>
							
							<?php if ($ext_show_p) : ?>
								<div><?php echo JText::_(ATMOSPHERE_PRESSURE);?>: <?php echo $xml->current->p; ?> <?php echo JText::_(MMHG);?></div>
							<?php endif;?>							
						</td>
					<?php endif;?>
					
					</tr>					
				
					
				</tbody>
			</table>
		<?php	
		} else {
			echo '<p style="color:red;">'.$ext_error.'</p>';
		}
		?>	
    </div>
	<div style="clear:both;"></div>
</div>
