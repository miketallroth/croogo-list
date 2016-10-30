<?php

App::uses('MenusHelper', 'Menus.View/Helper');

/**
 * List Plugin List Helper
 *
 * PHP version 5
 *
 * @category List.Helper
 * @package  List.View.Helper
 * @version  0.1
 * @author   Mike Tallroth
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.goclearsky.com
 */
class ListHelper extends MenusHelper {

	/**
	 * Nested List
	 *
	 * @param array $links model output (threaded)
	 * @param array $options (optional)
	 * @param integer $depth depth level
	 * @return string
	 */
	public function nestedList($links, $options = array(), $depth = 1) {
		$_options = array();
		$options = array_merge($_options, $options);

		$output = '';
		foreach ($links as $link) {
			$linkAttr = array(
				'id' => 'link-' . $link['Link']['id'],
				'rel' => $link['Link']['rel'],
				'target' => $link['Link']['target'],
				'title' => $link['Link']['description'],
				'class' => $link['Link']['class'],
			);

			$linkAttr = $this->_mergeLinkParams($link, 'linkAttr', $linkAttr);

			// if link is in the format: controller:contacts/action:view
			if (strstr($link['Link']['link'], 'controller:')) {
				$link['Link']['link'] = $this->linkStringToArray($link['Link']['link']);
			}

			$children = (isset($link['children']) && count($link['children']));

			// create html for this link
			$elOptions = array(
				'depth' => $depth,
				'link' => $link,
				'linkAttr' => $linkAttr,
			);
			if ($children) {
				// generate html for this link as a lead
				$linkOutput = $this->_View->element('List.linklist_lead', $elOptions);

				// handle (optional) depth based leadTags
				$leadTag = (!empty($options['leadTag'.$depth]) ? $options['leadTag'.$depth] : $options['leadTag']);

				// wrap this lead in a tag
				$tagAttr = array('class' => $options['leadClass']);
				$linkOutput = $this->Html->tag($leadTag, $linkOutput, $tagAttr);

				// now recurse deeper with the children
				$children = $this->nestedList($link['children'], $options, $depth + 1);

				// wrap children w/o lead
				if (!empty($options['itemsetTag'])) {
					$tagAttr = array('class' => $options['itemsetClass']);
					$children = $this->Html->tag($options['itemsetTag'], $children, $tagAttr);
				}

				$linkOutput .= $children;

				// wrap lead with children in a wrapper
				if (!empty($options['groupTag'])) {
					$tagAttr = array('class' => $options['groupClass']);
					$linkOutput = $this->Html->tag($options['groupTag'], $linkOutput, $tagAttr);
				}
			} else {
				// generate html for this link as an item
				$linkOutput = $this->_View->element('List.linklist_item', $elOptions);

				// handle (optional) depth based itemTags
				$itemTag = (!empty($options['itemTag'.$depth]) ? $options['itemTag'.$depth] : $options['itemTag']);

				// wrap this item in a tag
				if (!empty($options['itemTag'])) {
					$tagAttr = array('class' => $options['itemClass']);
					$linkOutput = $this->Html->tag($itemTag, $linkOutput, $tagAttr);
				}
			}

			$output .= $linkOutput;
		}

		return $output;
	}

}
