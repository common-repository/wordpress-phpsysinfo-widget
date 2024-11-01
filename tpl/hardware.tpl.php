<li>
	<h3> Hardware Information</h3>
	<?php if (get_option('hardware_proc')): ?>
	<div><u>Processors:</u> <?php print $xml_root_node->Hardware[0]->CPU[0]->Num[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('hardware_model')): ?>
	<div><u>Model:</u> <?php print $xml_root_node->Hardware[0]->CPU[0]->Model[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('hardware_cpuspeed')): ?>
	<div><u>CPU speed:</u> <?php print format_speed( $xml_root_node->Hardware[0]->CPU[0]->Cpuspeed[0] ) ?> </div>
	<?php endif; ?>
	<?php if (get_option('hardware_busspeed')): ?>
	<div><u>BUS speed:</u> <?php print format_speed( $xml_root_node->Hardware[0]->CPU[0]->Busspeed[0] ) ?> </div>
	<?php endif; ?>
	<?php if (get_option('hardware_cache')): ?>
	<div><u>Cache size:</u> <?php print $xml_root_node->Hardware[0]->CPU[0]->Cache[0] ?> </div>
	<?php endif; ?>
	<?php if (get_option('hardware_bogomips')): ?>
	<div><u>System Bogomips:</u> <?php print $xml_root_node->Hardware[0]->CPU[0]->Bogomips[0] ?> </div>
	<?php endif; ?>
</li>