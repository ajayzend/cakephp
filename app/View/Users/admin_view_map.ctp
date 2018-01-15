<div class="umtop">
	<?php echo $this->Session->flash(); ?>
	<?php //echo $this->element('dashboard'); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('View Map Details'); ?></span>
				<span class="umstyle2" style="float:right"><?php echo $this->Html->link(__("Manage Maps",true),"/admin/manageMaps"); ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid" id="index">
				<table cellspacing="0" cellpadding="0" width="100%" border="0" >
					<tbody>
			<?php       if (!empty($map)) { ?>
							<tr>
								<td><strong><?php echo __('Game Name');?></strong></td>
								<td><?php echo h($map['ManageGame']['name'])?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Map Name');?></strong></td>
								<td><?php echo h($map['ManageMap']['map_name'])?></td>
							</tr>
							
							<tr>
								<td><strong><?php echo __('Box Photo');?></strong></td>
								<td><?php echo $this->Html->image('/uploads/box_photo/thumbs/'.$map['ManageMap']['box_photo']); ?></td>
							</tr>
							
							<tr>
								<td><strong><?php echo __('Map Image');?></strong></td>
								<td><?php echo $this->Html->image('/uploads/map_image/thumbs_small/'.$map['ManageMap']['map_image']); ?></td>
							</tr>
		
							<tr>
								<td><strong><?php echo __('Created');?></strong></td>
								<td><?php echo date('d-M-Y',strtotime($map['ManageMap']['created']))?></td>
							</tr>
				<?php   } else {
							echo "<tr><td colspan=2><br/><br/>No Data</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>
