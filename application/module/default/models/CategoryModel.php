<?php
class CategoryModel extends Model{

	private $_columns = array('id','name','picture','created','created_by','modified','modified_by','status','ordering','privilege_id');
	private $_userInfo;

	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_CATEGORY);

		$userInfo 	=	Session::get('user');
		$this->_userInfo = $userInfo['info'];
	}

	public function listItems($arrParam, $options){
		$query[] 	= "SELECT `id`, `name`, `status`, `ordering`, `parend_id`se";
		$query[] 	= "FROM `$this->table` AS `c` ";
		$query[] 	= "WHERE `id` > 0";
		
		//FILTER: KEYWORD
		if(!empty($arrParam['filter-search'])){
			$keyword 	= '"%'.$arrParam['filter-search'].'%"';
			$query[] 	= "WHERE `name` LIKE $keyword";
		}

		//FILTER: STATUS
		if(isset($arrParam['filter-state']) && $arrParam['filter-state'] != 'default'){
			$query[] 	= "AND `status` ='".$arrParam['filter-state']."'";
		}

		//SORT
		if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir'])){
			$column 	=	$arrParam['filter_column'];
			$column_dir =	$arrParam['filter_column_dir'];
			$query[] 	= "ORDER BY `$column` $column_dir ";
		}else{
			$query[] 	= "ORDER BY `id` asc ";
		}

		$pagination 		= $arrParam['pagination'];
		$totalItemsPerPage 	= $pagination['totalItemsPerPage'];
		if($totalItemsPerPage > 0){
			$position		= ($pagination['currentPage'] - 1)*$totalItemsPerPage;
			$query[]		= "LIMIT $position, $totalItemsPerPage";
		}
		
		$query		= implode(" ", $query);
		$result 	= $this->fetchAll($query);

		return $result;
	}

	public function countItems($arrParam, $options){
		$query[] 	= "SELECT COUNT(`id`) AS `total`";
		$query[] 	= "FROM `$this->table`";
		$query[] 	= "WHERE `id` > 0";

		$flagWhere = false;
		
		//FILTER: KEYWORD
		if(!empty($arrParam['filter-search'])){
			$keyword 	= '"%'.$arrParam['filter-search'].'%"';
			$query[] 	= "WHERE `name` LIKE $keyword";
		}

		//FILTER: STATUS
		if(isset($arrParam['filter-state']) && $arrParam['filter-state'] != 'default'){
			$query[] 	= "AND `status` ='".$arrParam['filter-state']."'";

		}

		// echo
		$query		= implode(" ", $query);
		$result 	= $this->fetchRow($query);

		return $result['total'];
	}

}