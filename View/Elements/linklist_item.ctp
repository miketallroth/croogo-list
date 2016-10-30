<?php
	$l = $link['Link'];
	$desc = $l['description'];

	if (!empty($desc)) $desc = ' - ' . $desc;
	if (empty($linkAttr['target'])) $linkAttr['target'] = '_blank';

	$url = $this->Html->link($l['title'], $l['link'], $linkAttr);
	echo $url . $desc;
