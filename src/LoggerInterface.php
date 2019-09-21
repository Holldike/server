<?php

interface LoggerInterface
{
	public function write(string $message): void;
}
