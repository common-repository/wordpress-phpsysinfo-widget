<li>
	<h3> Mounted Filesystems </h3>
	<ul>
	<?php foreach ($xml_root_node->FileSystem[0] as $device): ?>
		<li>
		<?php if (get_option('filesystems_disk')): ?>
			<div><u>Disk:</u> <?php print $device->MountPoint[0] . ' ' . $device->Type[0] . ' ' . $device->Device[0]->Name[0] . ', ' ?> </div>
		<?php endif; ?>
		<?php if (get_option('filesystems_percent')): ?>
			<div><u>Percent:</u> 
			<div class="wp-progress-bar">
				<div class="wp-progress-percent" style="width:	<?php print $device->Percent[0]; ?>%;">
					<?php print $device->Percent[0]; ?>%
				</div>
		</div>
		<?php endif; ?>
		<?php if (get_option('filesystems_free')): ?>
			<div><u>Free:</u> <?php print format_bytesize ( $device->Free[0] ) ?> </div>
		<?php endif; ?>
		<?php if (get_option('filesystem_used')): ?>
			<div><u>Used:</u> <?php print format_bytesize ( $device->Used[0] ) ?> </div>
		<?php endif; ?>
		<?php if (get_option('filesystems_total')): ?>
			<div><u>Total:</u> <?php print format_bytesize ( $device->Size[0] ) ?> </div>
		<?php endif; ?>
		</li>
	<?php endforeach;?>
	</ul>
	
</li>
