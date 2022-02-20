<?php
class Pagination{
	
	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 1;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 5;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	private $currentPage			= 1;	// Trang hiện tại
	
	public function __construct($totalItems, $pagination){
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $pagination['totalItemsPerPage'];
		
		if($pagination['pageRange'] %2 == 0) $pagination['pageRange'] = $pagination['pageRange'] + 1;
		
		$this->pageRange			= $pagination['pageRange'];
		$this->currentPage			= $pagination['currentPage'];
		$this->totalPage			= ceil($totalItems/$pagination['totalItemsPerPage']);
	}
	
	public function showPagination($link){
		// Pagination
		$paginationHTML = '';
		if($this->totalPage > 1){
			$start 	= '<li><a href="#">Trang đầu</a></li>';
			$prev 	= '<li><a href="#">&laquo;</a></li>';
			if($this->currentPage > 1){
				$start 	= '<ul class="pagination"><li><a onclick="javascript:changePage(1)" href="#">Trang đầu</a></li>';
				$prev 	= '<li><a onclick="javascript:changePage('.($this->currentPage-1).')" href="#">&laquo;</a></li>';
			}
		
			$next 	= '<li><a href="#">&raquo;</a></li>';
			$end 	= '<li><a href="#">Trang cuối</a></li>';
			if($this->currentPage < $this->totalPage){
				$next 	= '<li><a onclick="javascript:changePage('.($this->currentPage+1).')" href="#">&raquo;</a></li>';
				$end 	= '<li><a href="#" onclick="javascript:changePage('.$this->totalPage.')">Trang cuối</a></li>';
			}
		
			if($this->pageRange < $this->totalPage){
				if($this->currentPage == 1){
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				}else if($this->currentPage == $this->totalPage){
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				}else{
					$startPage		= $this->currentPage - ($this->pageRange-1)/2;
					$endPage		= $this->currentPage + ($this->pageRange-1)/2;
		
					if($startPage < 1){
						$endPage	= $endPage + 1;
						$startPage = 1;
					}
		
					if($endPage > $this->totalPage){
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			}else{
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = '<li>';
			for($i = $startPage; $i <= $endPage; $i++){
				if($i == $this->currentPage) {
					$listPages .= '<span>'.$i.'</span>';
				}else{
					$listPages .= '<a href="#" onclick="javascript:changePage('.$i.')">'.$i.'</a>';
				}
			}
			$listPages .= '</li>';
			$endPagination	= '<div class="limit align-center-box text-primary"">Trang: '.$this->currentPage.' / '.$this->totalPage.'</div>';
			$paginationHTML = '<ul class="pagination">' . $start . $prev . $listPages . $next . $end . $endPagination . '</ul>';
		}
		return $paginationHTML;
	}
}