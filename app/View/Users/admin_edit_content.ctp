<div class="umtop">
	<?php echo $this->Session->flash(); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('Edit Games'); ?></span>
				<span class="umstyle2" style="float:right"><?php echo $this->Html->link(__("Manage Games",true),"/admin/manageContent") ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid" id="index">
				<?php echo $this->Form->create('ManageGame',array('label'=>false,'div'=>false));
					  echo $this->Form->hidden('id',array('value'=>$game['ManageGame']['id'])); ?>
				<table cellspacing="0" cellpadding="0" width="100%" border="0" >
					<tbody>
					<tr>
					<td>Name</td>
					<td><?php echo $this->Form->input('name',array('label'=>false,'div'=>false,'value'=>$game['ManageGame']['name'])); ?></td>
					<tr>
					<tr>
					<td>&nbsp;</td>
					<td><?php echo $this->Form->submit('Edit',array('label'=>false,'div'=>false)); ?></td>
					<tr>
					</tbody>
				</table>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>