<li>
	<h3> System Vital Information</h3>
	<?php if (get_option('vital_hostname')): ?>
	<div><u>Hostname:</u> <?php print $xml_root_node->Vitals[0]->Hostname[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('vital_ipaddr')): ?>
	<div><u>Listening IP:</u> <?php print $xml_root_node->Vitals[0]->IPAddr[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('vital_vkernel')): ?>
	<div><u>Kernel Version:</u> <?php print $xml_root_node->Vitals[0]->Kernel[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('vital_distro')): ?>
	<div><u>Distribution name:</u> <?php print $xml_root_node->Vitals[0]->Distro[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('vital_uptime')): ?>
	<div><u>Uptime:</u> <?php print uptime ( $xml_root_node->Vitals[0]->Uptime[0] ) ?> </div>
	<?php endif; ?>
	<?php if (get_option('vital_users')): ?>
	<div><u>Current Users:</u> <?php print $xml_root_node->Vitals[0]->Users[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('vital_load')): ?>
	<div><u>Load Averages:</u> <?php print $xml_root_node->Vitals[0]->LoadAvg[0] ?> </div>
	<?php endif; ?>
	
</li>
