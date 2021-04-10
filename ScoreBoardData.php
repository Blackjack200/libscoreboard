<?php


namespace libscoreboard;


final class ScoreBoardData {
	/** @var ScoreTag[] */
	private array $tags;
	private string $title;
	private bool $contentNeedUpdate;
	private bool $titleNeedUpdate;

	/**
	 * @param ScoreTag[] $tags
	 */
	public function __construct(array $tags, string $title) {
		$this->tags = $tags;
		$this->title = $title;
		$this->resetUpdate();
	}

	public function resetUpdate() : void {
		$this->titleNeedUpdate = false;
		$this->contentNeedUpdate = false;
	}

	public function contentNeedUpdate() : bool {
		return $this->contentNeedUpdate;
	}

	public function titleNeedUpdate() : bool {
		return $this->titleNeedUpdate;
	}

	/**
	 * @return ScoreTag[]
	 */
	public function getTags() : array {
		return $this->tags;
	}

	public function setTags(array $tags) : void {
		$this->triggerContentUpdate();
		$this->tags = $tags;
	}

	public function triggerContentUpdate() : void {
		$this->contentNeedUpdate = true;
	}

	public function getTitle() : string {
		return $this->title;
	}

	public function setTitle(string $title) : void {
		$this->triggerTitleUpdate();
		$this->title = $title;
	}

	public function triggerTitleUpdate() : void {
		$this->titleNeedUpdate = true;
	}
}