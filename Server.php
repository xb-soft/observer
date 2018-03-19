<?php
/**
 * xbsoft observer server
 *
 * @category php
 * @package xb.observer
 * @author enze.wei <[enzewei@gmail.com]>
 * @copyright 2017 xbsoft
 * @license http://xbsoft.net/licenses/mit.php MIT License
 * @version 0.0.2
 * @link http://docs.xbsoft.net/observer
 */
namespace xb\observer;

use \SplSubject;
use \SplObserver;

abstract class Server implements SplObserver {
	
	/**
	 * abstract method of task
	 *
	 * @param object $subject SplSubject
	 *
	 * @return void
	 */
	abstract public function doTask($subject);
	
	/**
	 * implements interface
	 *
	 * @param object $subject SplSubject
	 *
	 * @return void
	 */
	public function update(SplSubject $subject) {
		$this->doTask($subject);
	}
}