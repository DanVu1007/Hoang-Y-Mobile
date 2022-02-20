<?php
class UserModel extends Model{

	private $_columns = array('id','phone','username','email','fullname','password','created','created_by','modified','modified_by','register_date','register_ip','status','ordering','group_id');


	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_USER);
	}

	public function infoItem($arrParam, $option = null){
		if($option == null){
			$email		= $arrParam['form']['email'];
			$password	= md5($arrParam['form']['password']);

			$query[] 		= "SELECT `u`.`id`,`u`.`fullname`,`u`.`username`,`u`.`group_id`, `g`.`group_acp` ";
			$query[]		= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`" ;
			$query[]		= "WHERE `email` = '$email' AND `password` = '$password'";

			$query = implode(" ", $query);
			$result = $this->fetchRow($query);
			return $result;
		}
		if($option == 'showinfo'){
			$query[] 		= "SELECT `u`.`id`,`u`.`fullname`,`u`.`username`,`u`.`email`, `u`.`phone`, `u`.`ordering` ";
			$query[]		= "FROM `user` AS `u`" ;
			$query[]		= "WHERE `id` = '$arrParam'";

			$query = implode(" ", $query);
			$result = $this->fetchRow($query);
			return $result;
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
	
}