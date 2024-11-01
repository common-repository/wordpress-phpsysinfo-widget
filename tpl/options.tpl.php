
<?php $phpsysinfo_options = array();?>
<div class="wrap">
	<h2>System information plugin</h2>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					Widget Title
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'widget_title' ); ?>
					<input type="text" value="<?php print get_option('widget_title') ?>" name="widget_title" />
				</td>
			</tr>
					
			<tr valign="top">
				<th scope="row">
					Widget Description
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'widget_description' ); ?>
					<textarea name="widget_description"><?php print get_option('widget_description') ?></textarea>
				</td>
			</tr>
					
			<tr valign="top">
				<th scope="row">
					Vital Information Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'vital' ); ?>
					No <input type="radio" value="0" name="vital" <?php print checked('0', get_option('vital'))?> />
					Yes <input type="radio" value="1" name="vital" <?php print checked('1', get_option('vital'))?> />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					Other Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'vital_hostname' ); ?>
					<div>
						<input type="checkbox" name="vital_hostname" value="1" <?php print checked('1', get_option('vital_hostname'))?>>
						<span>Show Hostname</span>
					</div>
					
					<?php array_push ( $phpsysinfo_options, 'vital_ipaddr' ); ?>
					<div>
						<input type="checkbox" name="vital_ipaddr" value="1" <?php print checked('1', get_option('vital_ipaddr'))?>>
						<span>Show Listening IP</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'vital_vkernel' ); ?>
					<div>
						<input type="checkbox" name="vital_vkernel" value="1" <?php print checked('1', get_option('vital_vkernel'))?>>
						<span>Show Kernel version</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'vital_distro' ); ?>
					<div>
						<input type="checkbox" name="vital_distro" value="1" <?php print checked('1', get_option('vital_distro'))?>>
						<span>Show Distribution name</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'vital_uptime' ); ?>
					<div>
						<input type="checkbox" name="vital_uptime" value="1" <?php print checked('1', get_option('vital_uptime'))?>>
						<span>Show Uptime</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'vital_users' ); ?>
					<div>
						<input type="checkbox" name="vital_users" value="1" <?php print checked('1', get_option('vital_users'))?>>
						<span>Display Current User</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'vital_load' ); ?>
					<div>
						<input type="checkbox" name="vital_load" value="1" <?php print checked('1', get_option('vital_load'))?>>
						<span>Display Load Average</span>
					</div>

				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					Hardware Information Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'hardware' ); ?>
					No <input type="radio" value="0" name="hardware" <?php print checked('0', get_option('hardware'))?> />
					Yes <input type="radio" value="1" name="hardware" <?php print checked('1', get_option('hardware'))?> />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					Other Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'hardware_proc' ); ?>
					<div>
						<input type="checkbox" name="hardware_proc" value="1" <?php print checked('1', get_option('hardware_proc'))?>>
						<span>Display Processors</span>
					</div>
					
					<?php array_push ( $phpsysinfo_options, 'hardware_model' ); ?>
					<div>
						<input type="checkbox" name="hardware_model" value="1" <?php print checked('1', get_option('hardware_model'))?>>
						<span>Display Model</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'hardware_cpuspeed' ); ?>
					<div>
						<input type="checkbox" name="hardware_cpuspeed" value="1" <?php print checked('1', get_option('hardware_cpuspeed'))?>>
						<span>Display CPU speed</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'hardware_busspeed' ); ?>
					<div>
						<input type="checkbox" name="hardware_busspeed" value="1" <?php print checked('1', get_option('hardware_busspeed'))?>>
						<span>Display Bus Speed</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'hardware_cache' ); ?>
					<div>
						<input type="checkbox" name="hardware_cache" value="1" <?php print checked('1', get_option('hardware_cache'))?>>
						<span>Display cache size</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'hardware_bogomips' ); ?>
					<div>
						<input type="checkbox" name="hardware_bogomips" value="1" <?php print checked('1', get_option('hardware_bogomips'))?>>
						<span>Display Bogomips</span>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					Memory Usage Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'memory' ); ?>
					No <input type="radio" value="0" name="memory" <?php print checked('0', get_option('memory'))?> />
					Yes <input type="radio" value="1" name="memory" <?php print checked('1', get_option('memory'))?> />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					Other Memory Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'memory_free' ); ?>
					<div>
						<input type="checkbox" name="memory_free" value="1" <?php print checked('1', get_option('memory_free'))?>>
						<span>Display Memory Free</span>
					</div>
					
					<?php array_push ( $phpsysinfo_options, 'memory_used' ); ?>
					<div>
						<input type="checkbox" name="memory_used" value="1" <?php print checked('1', get_option('memory_used'))?>>
						<span>Display Memory used</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'memory_total' ); ?>
					<div>
						<input type="checkbox" name="memory_total" value="1" <?php print checked('1', get_option('memory_total'))?>>
						<span>Display Memory Total</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'memory_percent' ); ?>
					<div>
						<input type="checkbox" name="memory_percent" value="1" <?php print checked('1', get_option('memory_percent'))?>>
						<span>Display Memory percent</span>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					Network Usage Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'network' ); ?>
					No <input type="radio" value="0" name="network" <?php print checked('0', get_option('network'))?> />
					Yes <input type="radio" value="1" name="network" <?php print checked('1', get_option('network'))?> />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					Other Network Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'network_name' ); ?>
					<div>
						<input type="checkbox" name="network_name" value="1" <?php print checked('1', get_option('network_name'))?>>
						<span>Display Network name</span>
					</div>
					
					<?php array_push ( $phpsysinfo_options, 'network_rx' ); ?>
					<div>
						<input type="checkbox" name="network_rx" value="1" <?php print checked('1', get_option('network_rx'))?>>
						<span>Display Network received</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'network_tx' ); ?>
					<div>
						<input type="checkbox" name="network_tx" value="1" <?php print checked('1', get_option('network_tx'))?>>
						<span>Display Network Transfered</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'network_drop' ); ?>
					<div>
						<input type="checkbox" name="network_drop" value="1" <?php print checked('1', get_option('network_drop'))?>>
						<span>Display Network drop / Error</span>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					Mounted Filesystems Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'filesystems' ); ?>
					No <input type="radio" value="0" name="filesystems" <?php print checked('0', get_option('filesystems'))?> />
					Yes <input type="radio" value="1" name="filesystems" <?php print checked('1', get_option('filesystems'))?> />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					Other Mounted filesystems Options
				</th>
				<td>
					<?php array_push ( $phpsysinfo_options, 'filesystems_disk' ); ?>
					<div>
						<input type="checkbox" name="filesystems_disk" value="1" <?php print checked('1', get_option('filesystems_disk'))?>>
						<span>Display Filesystems disk</span>
					</div>
					
					<?php array_push ( $phpsysinfo_options, 'filesystems_percent' ); ?>
					<div>
						<input type="checkbox" name="filesystems_percent" value="1" <?php print checked('1', get_option('filesystems_percent'))?>>
						<span>Display Filesystems percent</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'filesystems_free' ); ?>
					<div>
						<input type="checkbox" name="filesystems_free" value="1" <?php print checked('1', get_option('filesystems_free'))?>>
						<span>Display Filesystems free</span>
					</div>

					<?php array_push ( $phpsysinfo_options, 'filesystems_used' ); ?>
					<div>
						<input type="checkbox" name="filesystems_used" value="1" <?php print checked('1', get_option('filesystems_used'))?>>
						<span>Display Filesystems used</span>
					</div>
					<?php array_push ( $phpsysinfo_options, 'filesystems_total' ); ?>
					<div>
						<input type="checkbox" name="filesystems_total" value="1" <?php print checked('1', get_option('filesystems_total'))?>>
						<span>Display Filesystems Total</span>
					</div>
				</td>
			</tr>

		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php print implode(',', $phpsysinfo_options); ?>" />

		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>

	</form>
</div>
