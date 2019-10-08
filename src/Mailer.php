<?php

class Mailer {
	private $connects = [];

	public function addConnect(Connect $connect) {
		$this->connects[$connect->getId()] = $connect;
	}

	public function sendOut(array $message) {
	    unset($this->connects[$message['connect_id']]);
		foreach ($this->connects as $connect) {
			$connect->updateBuffer($message['body']);
		}
	}
}
