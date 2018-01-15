
<div class="pagination ">
	<ul class="pull-right">
	<li>
	<?php echo $this->Paginator->first('First', array(), null, array('class' => 'first disabled')); ?>
	</li>
	<li>
	<?php echo $this->Paginator->prev('Prev', array(), null, array('class' => 'prev disabled')); ?>
	</li>
	<li>
	<?php echo $this->Paginator->numbers(array('separator' => ' ')); ?>
	</li>
	<li>
	<?php echo $this->Paginator->next('Next', array(), null, array('class' => 'next disabled')); ?>
	</li>
	<li>
	<?php echo $this->Paginator->last('Last', array(), null, array('class' => 'last disabled')); ?>
	</li>
	</ul>
</div>

