<div id="list-<?php echo $menu['Menu']['id']; ?>" class="list">
<?php
	$_options = array(
		'listTag' => 'ul',      // wraps entire list
		'listClass' => '',
		'groupTag' => null,     // wraps each lead with its item set
		'groupClass' => '',
		'leadTag' => 'h3',      // wraps each lead
		'leadClass' => '',
		'itemsetTag' => null,   // wraps each set of items w/o lead
		'itemsetClass' => '',
		'itemTag' => 'li',      // wraps each item (link)
		'itemClass' => '',
	);
	$options = array_merge($_options, $options);

	$list = $this->List->nestedList($menu['threaded'], $options);
	echo $this->Html->tag($options['listTag'], $list, array('class' => $options['listClass']));
?>
</div>
