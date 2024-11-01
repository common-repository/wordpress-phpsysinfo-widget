<?php foreach($a as $key => $array): ?>
	<?php if (in_array($fl, $array)):?>
		<?php print $t[$key]; break;?>
		
	<?php endif; ?>
<?php endforeach; ?>
