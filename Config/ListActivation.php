<?php
/**
 * List Activation
 *
 * Activation class for List plugin.
 *
 * @package  List
 * @author   Mike Tallroth <mike.tallroth@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://github.com/miketallroth/croogo-list
 */
class ListActivation {

	public function beforeActivation(Controller $controller) {
		return true;
	}

	public function onActivation(Controller $controller) {
		return true;
	}

	public function beforeDeactivation(Controller $controller) {
		return true;
	}

	public function onDeactivation(Controller $controller) {
	}

}
