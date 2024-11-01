<li>
	<h3> Network usage</h3>
	<ul>
	<?php foreach ($xml_root_node->Network[0]->NetDevice as $device): ?>
		<li>
			<?php if (get_option('network_name')): ?>
			<div><u>Name:</u> <?php print $device->Name[0]; ?> </div>
			<?php endif; ?>
			<?php if (get_option('network_rx')): ?>
			<div><u>Received:</u> <?php print format_bytesize ( $device->RxBytes[0] ); ?> </div>
			<?php endif; ?>
			<?php if (get_option('network_tx')): ?>
			<div><u>Transfered:</u> <?php print format_bytesize ( $device->TxBytes[0] ); ?> </div>
			<?php endif; ?>
			<?php if (get_option('network_drop')): ?>
			<div><u>Drop/Error:</u> <?php print $device->Err[0]; ?> / <?php print $device->Drops[0]; ?> </div>
			<?php endif; ?>
		</li>
	<?php endforeach;?>
	</ul>
	
</li>
