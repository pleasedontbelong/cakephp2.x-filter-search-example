<?php
$this->Html->css('base', null, array('inline' => false));
?>
<div class="movies index">
	<h2><?php echo __('Movies'); ?></h2>
	
	<div class="filters">
		<h3>Filters</h3>
		<?php
		// The base url is the url where we'll pass the filter parameters
		$base_url = array('controller' => 'movies', 'action' => 'index');
		echo $this->Form->create("Filter",array('url' => $base_url, 'class' => 'filter'));
		// add a select input for each filter. It's a good idea to add a empty value and set
		// the default option to that.
		echo $this->Form->input("genre_id", array('label' => 'Genre', 'options' => $genres, 'empty' => '-- All genres --', 'default' => ''));
		echo $this->Form->input("director_id", array('label' => 'Director', 'options' => $directors, 'empty' => '-- All directors --', 'default' => ''));
		// Add a basic search 
		echo $this->Form->input("search", array('label' => 'Search', 'placeholder' => "Search..."));

		echo $this->Form->submit("Valider");

		// To reset all the filters we only need to redirect to the base_url
		echo "<div class='submit actions'>";
		echo $this->Html->link("Reset",$base_url);
		echo "</div>";
		echo $this->Form->end();
		?>
	</div>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th>Genre</th>
			<th>Director</th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th>Description</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($movies as $movie): ?>
	<tr>
		<td><?php echo h($movie['Movie']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $movie['Genre']['label']; ?>
		</td>
		<td>
			<?php echo $movie['Director']['name']; ?>
		</td>

		<td><?php echo $this->Text->highlight(h($movie['Movie']['title']), $search); ?>&nbsp;</td>
		<td><?php echo $this->Text->highlight(h($movie['Movie']['description']), $search); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $movie['Movie']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $movie['Movie']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $movie['Movie']['id']), null, __('Are you sure you want to delete # %s?', $movie['Movie']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Movie'), array('action' => 'add')); ?></li>
		
	</ul>
</div>
