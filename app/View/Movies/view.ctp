<div class="movies view">
<h2><?php  echo __('Movie'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($movie['Movie']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Genre'); ?></dt>
		<dd>
			<?php echo $this->Html->link($movie['Genre']['label'], array('controller' => 'genres', 'action' => 'view', $movie['Genre']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Director'); ?></dt>
		<dd>
			<?php echo $this->Html->link($movie['Director']['name'], array('controller' => 'directors', 'action' => 'view', $movie['Director']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($movie['Movie']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($movie['Movie']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Movie'), array('action' => 'edit', $movie['Movie']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Movie'), array('action' => 'delete', $movie['Movie']['id']), null, __('Are you sure you want to delete # %s?', $movie['Movie']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Movies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movie'), array('action' => 'add')); ?> </li>
		
	</ul>
</div>
