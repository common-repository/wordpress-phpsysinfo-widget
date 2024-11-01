<li>
	<h3> Memory usage</h3>
	<div><u><h4>Physical Memory</h4></u></div>
	<?php if (get_option('memory_free')): ?>
	<div><u>Free:</u> <?php print format_bytesize ( $xml_root_node->Memory[0]->Free[0] ); ?> </div>
	<?php endif; ?>
	<?php if (get_option('memory_used')): ?>
	<div><u>Used:</u> <?php print format_bytesize ( $xml_root_node->Memory[0]->Used[0] ); ?> </div>
	<?php endif; ?>
	<?php if (get_option('memory_total')): ?>
	<div><u>Total:</u> <?php print format_bytesize ( $xml_root_node->Memory[0]->Total[0] ); ?>  <?php print $device->Drops[0]; ?> </div>
	<?php endif; ?>
	<?php if (get_option('memory_percent')): ?>
	<div>
		<u>Percent:</u> 
		<div class="wp-progress-bar">
			<div class="wp-progress-percent" style="width:	<?php print $xml_root_node->Memory[0]->Percent[0]; ?>%;">
				<?php print $xml_root_node->Memory[0]->Percent[0]; ?>%
			</div>
		</div>
	</div>
	<?php endif; ?>
</li>
