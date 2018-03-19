<?php
/**
 * xbsoft observer subject
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
use \SplObjectStorage;

class Subject implements SplSubject {
	
	/*
	 * observer storage
	 */
	private $_observers = null;
	
	/*
	 * bind pool
	 */
	private $_locate = [];
	
	public function __construct() {
		$this->_observers = new SplObjectStorage;
	}
	
	/**
	 * attach observer to storage
	 *
	 * @param object $observer SplObserver
	 *
	 * @return void
	 */
	public function attach(SplObserver $observer) {
		$this->_observers->attach($observer);
	}
	
	/**
	 * detach observer from storage
	 *
	 * @param object $observer SplObserver
	 *
	 * @return void
	 */
	public function detach(SplObserver $observer) {
		$this->_observers->detach($observer);
	}

	/**
	 * notify all observer do sth.
	 *
	 * @return void
	 */
	public function notify() {
		foreach ($this->_observers as $observer) {
			$observer->update($this);
		}
	}
	
	/**
	 * bind data to locate
	 * u can called in observer
	 *
	 * @param string $name
	 * @param mix $data [callable|string|array|etc.,]
	 *
	 * @return void
	 */
	public function bind($name, $data) {
		$name = strtolower($name);
		if (true === is_callable($data)) {
			$this->_locate[$name] = call_user_func($data);
		} else {
			$this->_locate[$name] = $data;
		}
	}

	/**
	 * magic method
	 *
	 * @param string $name key of locate
	 *
	 * @return mix [false|bind data type]
	 */
	public function __get($name) {
		$name = strtolower($name);
		/*
		 * if key exists return storage data
		 */
		if (true === array_key_exists($name, $this->_locate)) {
			return $this->_locate[$name];
		}
		return false;
	}
}