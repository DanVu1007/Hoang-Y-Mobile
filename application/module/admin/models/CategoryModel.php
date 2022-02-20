<?php
class CategoryModel extends Model{

	private $_columns = array('id','name','picture','created','created_by','modified','modified_by','status','ordering','privilege_id','icon','parend_id');
	private $_userInfo;

	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_CATEGORY);

		$userInfo 	=	Session::get('user');
		$this->_userInfo = $userInfo['info'];
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

	public function listItems($arrParam, $options){
		$query[] 	= "SELECT `id`, `name`, `picture`, `status`, `ordering`, `created`, `created_by`, `modified_by`, `modified`, `icon`";
		$query[] 	= "FROM `$this->table`";
		$query[] 	= "WHERE `id` > 0";

		// [filter_column] => name
		// [filter_column_dir] => asc


		
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
		
		$query		= implode(" ", $query);
		$result 	= $this->fetchAll($query);

		return $result;
	}

	public function changeStatus($arrParam, $options = null){
		//Chang status -- AJAX
		if($options['task'] == 'change-ajax-status'){
			$status 		= ($arrParam['status'] == 0) ? 1 : 0;
			$id 			= $arrParam['id'];
			$modified 		= date('Y-m-d',time());
			$modified_by 	= $this->_userInfo['id'];

			$query 	= "UPDATE `$this->table` SET `status`='$status',`modified` = '$modified',`modified_by` = '$modified_by'  WHERE `id` = '$id'";
			$this->query($query);

			$result = array(
								'id' => $id, 
								'status' => $status, 
								'link' => URL::createURL('admin','category','ajaxStatus',array('id'=>$id,'status'=> $status)) , 
			);

			return $result;
			// return json_encode(array($id, $status, URL::createURL('admin','category','ajaxStatus',array('id'=>$id,'status'=> $status)) ));
		}


		//CHANGE STATUS --  BY BUTTON
		if($options['task'] == 'change-status'){
			$status = $arrParam['type']; 
			if(!empty($arrParam['cid'])){
				$ids 	= $this->createWhereDeleteSQL($arrParam['cid']);
				$modified 		= date('Y-m-d',time());
				$modified_by 	= $this->_userInfo['id'];
				$query 	= "UPDATE `$this->table` SET `status`='$status' ,`modified` = '$modified',`modified_by` = '$modified_by' WHERE `id` IN ($ids)";
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

			//REMOVE IMAGE
			$query 		= "SELECT `id`, `picture` AS `name` FROM `$this->table` WHERE `id` IN ($ids)";
			$arrImage 	= $this->fetchPairs($query);
			require_once LIBRARY_EXT_PATH.'Upload.php';
			$uploadObj	=	new Upload();
			foreach ($arrImage as  $value) {
				$uploadObj->removeFile('category',$value);
			}

			//DELETE FROM DATABASE
			$query 		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
			$this->query($query);

			Session::set('message', array('class' => 'success', 'content' => 'Đã xóa '.$this->affectedRows().' phần tử!'));

		}else{
			Session::set('message', array('class' => 'warning', 'content' => 'Vui lòng chọn vào phần tử muốn xóa!'));
		}
	}

	public function saveItems($arrParam, $options = null){


		// exit();
		require_once LIBRARY_EXT_PATH.'Upload.php';
		$uploadObj	=	new Upload();

		if($options['task'] == 'add'){
			if($arrParam['form']['picture']['name'] != ''){
				$arrParam['form']['picture'] = $uploadObj->uploadFile($arrParam['form']['picture'],'category');
			}else{
				unset($arrParam['form']['picture']);
			}

			$arrParam['form']['created'] = date('Y-m-d',time());
			$arrParam['form']['created_by'] = $this->_userInfo['id'];

			$data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
			$this->insert($data);
		}
		if($options['task'] == 'edit'){
				$data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
				$data['modified'] = date('Y-m-d',time());
				$data['modified_by'] = $this->_userInfo['id'];
				if($data['picture']['name']==null){
					unset($data['picture']);
				}else{
					if($data['picture_hidden'] == null){
						unset($data['picture_hidden']);
					}else{
						$uploadObj->removeFile('category',$data['picture_hidden']);
					}
					$data['picture'] = $uploadObj->uploadFile($data['picture'],'category');
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
			//REMOVE IMAGE
			$id	=  $arrParam['id'];
			$query 		= "SELECT `picture` FROM `$this->table` WHERE `id` = $id";
			$img		= $this->fetchRow($query)['picture'];
			require_once LIBRARY_EXT_PATH.'Upload.php';
			$uploadObj	=	new Upload();

			$uploadObj->removeFile('category',$img);

			//DELETE FROM DATABASE
			$query 	= "DELETE FROM `$this->table` WHERE `id`= '".$arrParam['id']."'";
			$this->query($query);
			Session::set('message', array('class' => 'success', 'content' => 'Đã xóa phần tử có id = '.$arrParam['id'].'!'));
		}
	}
}