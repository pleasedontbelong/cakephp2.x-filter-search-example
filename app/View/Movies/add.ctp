<div class="movies form">
<?php echo $this->Form->create('Movie'); ?>
	<fieldset>
		<legend><?php echo __('Add Movie'); ?></legend>
	<?php
		echo $this->Form->input('genre_id');
		echo $this->Form->input('director_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Movies'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
