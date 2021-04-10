<?php


namespace libscoreboard;


class ScoreTag {
	protected string $value;
	protected ScoreBoardData $data;

	public function __construct(string $value, ScoreBoardData $data) {
		$this->value = $value;
		$this->data = $data;
	}

	public function update(string $value) : void {
		$this->data->triggerContentUpdate();
		$this->value = $value;
	}

	public function get() : string {
		return $this->value;
	}
}