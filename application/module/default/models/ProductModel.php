<?php
class ProductModel extends Model{
	private $_columns = array('id','name','description','price','special','sale_off','picture','created','created_by','modified','modified_by','status','ordering','category_id','promote_id','img_list_id','comment_id');



	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_PRODUCT);
	}

	public function infoItem($arrParam, $option = null){
		if($option['task'] == 'get-category-name'){
			$query[] 		= "SELECT `name` FROM `".TBL_CATEGORY."` WHERE `id` = ".$arrParam['category_id']." ";
			$query = implode(" ", $query);
			$result = $this->fetchRow($query);

			return $result['name'];
		}
	}

	public function listItems($arrParam, $options){
		if($options['task'] == 'product-in-category'){
			$catID		= $arrParam['category_id'];
			$query[] 	= "SELECT `id`, `name`, `status`,`picture`, `ordering`,`price`,`sale_off`";
			$query[] 	= "FROM `$this->table`";
			$query[] 	= "WHERE `status` = 1 AND `category_id` = $catID";
			$query[] 	= "ORDER BY `ordering` ASC";
	
			$query		= implode(" ", $query);
			$result 	= $this->fetchAll($query);
	
			return $result;
		}
	}

	public function countItems($arrParam, $options){
		$query[] 	= "SELECT COUNT(`id`) AS `total`";
		$query[] 	= "FROM `$this->table`";
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


		$query		= implode(" ", $query);
		$result 	= $this->fetchRow($query);

		return $result['total'];
	}

}