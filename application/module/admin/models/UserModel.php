<?php
class UserModel extends Model{

	private $_columns = array('id','phone','username','email','fullname','password','created','created_by','modified','modified_by','register_date','register_ip','status','ordering','group_id');

	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_USER);
	}

	public function countItems($arrParam, $options){
		$query[] 	= "SELECT COUNT(`id`) AS `total`";
		$query[] 	= "FROM `$this->table`";
		$query[] 	= "WHERE `id` > 0";

		//FILTER: KEYWORD
		if(!empty($arrParam['filter-search'])){
			$keyword 	= '"%'.$arrParam['filter-search'].'%"';
			$query[] 	= "AND (`username` LIKE $keyword OR `email` LIKE $keyword) ";
		}

		//FILTER: STATUS
		if(isset($arrParam['filter-state']) && $arrParam['filter-state'] != 'default'){
			$query[] 	= "AND `status` ='".$arrParam['filter-state']."'";

		}
		//FILTER: filter-group
		if(isset($arrParam['filter-group']) && $arrParam['filter-group'] != 'default'){
			$query[] 	= "AND `group_id` ='".$arrParam['filter-group']."'";

		}


		 $query		= implode(" ", $query);
		$result 	= $this->fetchRow($query);

		return $result['total'];
	}

	public function listItems($arrParam, $options){
		$query[] 	= "SELECT `u`.`id`,`u`.`username`,`u`.`email`,`u`.`fullname`,`u`.`password`,`u`.`phone`,`u`.`created`,`u`.`created_by`,`u`.`modified`,`u`.`modified_by`,`u`.`register_date`,`u`.`register_ip`,`u`.`status`,`u`.`ordering`,`g`.`name` AS `group_name`";
		$query[] 	= "FROM `$this->table` AS `u`,`".TBL_GROUP."` AS `g`";
		$query[] 	= "WHERE `u`.`group_id` = `g`.`id`";



		//FILTER: KEYWORD
		if(!empty($arrParam['filter-search'])){
			$keyword 	= '"%'.$arrParam['filter-search'].'%"';
			$query[] 	= " AND (`username` LIKE $keyword OR `email` LIKE $keyword)";

		}

		//FILTER: STATUS
		if(isset($arrParam['filter-state']) && $arrParam['filter-state'] != 'default'){
			$query[] 	= "AND `u`.`status` ='".$arrParam['filter-state']."'";
		}
		//FILTER: STATUS
		if(isset($arrParam['filter-group']) && $arrParam['filter-group'] != 'default'){
			$query[] 	= "AND `u`.`group_id` ='".$arrParam['filter-group']."'";
		}

		// echo '<pre>';
		// print_r($arrParam);
		// echo '</pre>';
		//FILTER: group
		if(isset($arrParam['filter-group']) && $arrParam['filter-group'] != 'default'){
			$query[] 	= "AND `u`.`group_id` ='".$arrParam['filter-group']."'";
		}

		
		//SORT
		if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir'])){
			$column 	=	$arrParam['filter_column'];
			$column_dir =	$arrParam['filter_column_dir'];
			$query[] 	= "ORDER BY `$column` $column_dir ";
		}else{
			$query[] 	= "ORDER BY `id` asc ";
		}

		//PAGINATION
		// echo '<pre>';
		// print_r($arrParam);
		// echo '</pre>';
		$pagination 		= $arrParam['pagination'];
		$totalItemsPerPage 	= $pagination['totalItemsPerPage'];
		if($totalItemsPerPage > 0){
			$position		= ($pagination['currentPage'] - 1)*$totalItemsPerPage;
			$query[]		= "LIMIT $position, $totalItemsPerPage";
		}


		//CÂU LỆNH QUERY-----------------------------------------------
		// echo
		$query		= implode(" ", $query);
		$result 	= $this->fetchAll($query);

		return $result;
	}

	public function changeStatus($arrParam, $options = null){
		//Chang status -- AJAX
		if($options['task'] == 'change-ajax-status'){
			$status = ($arrParam['status'] == 0) ? 1 : 0;
			$id 	= $arrParam['id'];

			$query 	= "UPDATE `$this->table` SET `status`='$status' WHERE `id` = '$id'";
			$this->query($query);

			$result = array(
								'id' => $id, 
								'status' => $status, 
								'link' => URL::createURL('admin','user','ajaxStatus',array('id'=>$id,'status'=> $status)) , 
			);

			return $result;
		}



		//CHANGE STATUS --  BY BUTTON
		if($options['task'] == 'change-status'){
			$status = $arrParam['type']; 
			if(!empty($arrParam['cid'])){
				$ids 	= $this->createWhereDeleteSQL($arrParam['cid']);
				$query 	= "UPDATE `$this->table` SET `status`='$status' WHERE `id` IN ($ids)";
				$this->query($query);
				Session::set('message', array('class' => 'success', 'content' => 'Đã thay cập nhật lại trạng thái cho '.$this->affectedRows().' phần tử!'));
			}else{
				Session::set('message', array('class' => 'warning', 'content' => 'Vui lòng chọn vào phần tử muốn thay đổi trạng thái!'));
			}

		};

		//DELETE ITEM -- BY BUTTON
		if($options['task'] == 'deleteAction'){
			if(!empty($arrParam['cid'])){
				$ids 	= $this->createWhereDeleteSQL($arrParam['cid']);
				$query 	= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
				$this->query($query);
				Session::set('message', array('class' => 'success', 'content' => 'Đã xóa '.$this->affectedRows().' phần tử!'));
			}else{
				Session::set('message', array('class' => 'warning', 'content' => 'Vui lòng chọn vào phần tử muốn xóa!'));
			}

		};
	}
 
	public function deleteItems($arrParam, $options = null){
		if(!empty($arrParam['cid'])){
			$ids 	= $this->createWhereDeleteSQL($arrParam['cid']);
			$query 	= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
			$this->query($query);
			Session::set('message', array('class' => 'success', 'content' => 'Đã xóa '.$this->affectedRows().' phần tử!'));

		}else{
			Session::set('message', array('class' => 'warning', 'content' => 'Vui lòng chọn vào phần tử muốn xóa!'));
		}
	}

	public function saveItems($arrParam, $options = null){
		if($options['task'] == 'add'){
			$arrParam['form']['created'] 	= date('Y-m-d',time());
			$arrParam['form']['created_by'] = 1;
			$arrParam['form']['password']	= md5($arrParam['form']['password']);

			$data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';exit();
			$this->insert($data);
		}
		if($options['task'] == 'edit'){
			$data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
			$data['modified'] = date('Y-m-d',time());
			$data['modified_by'] = 10;
			if($data['password'] ==''){
				unset($data['password']);
			}else{
				$data['password'] = md5($data['password']);
			}
			$this->update($data,array(array('id',$arrParam['id'],'')));
			Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được cập nhật thành công!'));
			
		}
	}

	public function ordering($arrParam, $options = null){
		if($options == null){ 
			if(!empty($arrParam['order'])){
				$i = 0;
				foreach ($arrParam['order'] as $id => $ordering) {
					$i++;
					$query 	= "UPDATE `$this->table` SET `ordering`='$ordering' WHERE `id` = '$id'";
					$this->query($query);
				}
				Session::set('message', array('class' => 'success', 'content' => 'Đã thay cập nhật ordering cho '.$i.' phần tử!'));
			}
		}
	}

	//FILL FORM FOR EDIT
	public function infoItem($arrParam, $options = null){
		if($options == null){
			// $query[] 	= "SELECT `id`,`username`,`email`,`fullname`,`created`,`created_by`,`modified`,`modified_by`,`register_date`,`register_ip`,`status`,`ordering`,`group_id`";
			$query[] 	= "SELECT *";
			$query[] 	= "FROM `$this->table`";
			$query[] 	= "WHERE `id` = '".$arrParam['id']."'";
			$query		= implode(" ", $query);
			$result 	= $this->fetchRow($query);
			return $result;
		}
	}

	//DELETE AN ITEM
	public function removeItem($arrParam, $options = null){
		if($options == null){
			$query 	= "DELETE FROM `$this->table` WHERE `id`= '".$arrParam['id']."'";
			$this->query($query);
			Session::set('message', array('class' => 'success', 'content' => 'Đã xóa phần tử có id = '.$arrParam['id'].'!'));
		}
	}

	public function itemInSelectBox($arrParam, $defaultName = '-Lựa chọn-', $option=null){
		if($option == null){
			$query 		= "SELECT `id`, `name` FROM `".TBL_GROUP."`" ;
			$result		= $this->fetchPairs($query);
			$result['default'] = $defaultName;
			ksort($result );
		}
		return $result;
	}
}