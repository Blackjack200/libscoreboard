<?php


namespace libscoreboard;


class ScoreTag {
	protected string $value;

	public function __construct(string $value) {
		$this->value = $value;
	}

	public function update(string $value) : void {
		$this->value = $value;
	}

	public function get() : string {
		return $this->value;
	}
}