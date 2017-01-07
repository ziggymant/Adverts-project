<?php

class Pagination {

	public $total_count;
	public $per_page;
	public $current_page;

	public function __construct($page = 1, $per_page = 20, $total_count = 0) {
		$this->current_page = (int)$page;
		$this->per_page = (int)$per_page;
		$this->total_count = (int)$total_count;
	}

	public function offset() {
		// assuming 20 items per page
		// page 1 has an offset of 0  i.e. (1-1) * 20
		// page 2 has an offset of 20  i.e. (2-1) * 20
		// ie. page 2 starts with item 21

		return ($this->current_page - 1) * $this->per_page;
	}

	public function total_pages() {
		return ceil($this->total_count / $this->per_page);
	}

	public function previous_page() {
		return $this->current_page - 1;
	}

	public function next_page() {
		return $this->current_page + 1;
	}

	public function has_previous_page() {
		return $this->previous_page() > 0 ? true : false;
	}

	public function has_next_page() {
		return $this->next_page() <= $this->total_pages() ? true : false;
	}







}



?>