<?php
class UserController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
		$this->_view->_title = 'Danbmr';

		$profileId 		= Session::get('user')['info']['id'];
		$userProfile 	= $this->_model->infoItem($profileId,'showinfo');

		$this->_view->_title = "Thông tin người dùng: ".$userProfile['fullname']."";
		$this->_view->arrParam['form'] = $userProfile;
	
		$this->_view->render('user/index');
	}


	public function loginAction(){
		$this->_view->_title = 'Login';
		// echo '<pre>';
		// print_r($this->_arrParam);
		// echo '</pre>';
		$this->_view->render('user/register');
	}

	public function updateProfileAction(){
		$this->_view->_title = 'Cập nhật tài khoản';
		$profileId 		= Session::get('user')['info']['id'];
		$userProfile 	= $this->_model->infoItem($profileId,'showinfo');
		if(		$userProfile['username'] == $this->_arrParam['form']['username'] 
		&&	$userProfile['email'] == $this->_arrParam['form']['email']
		&&	$userProfile['phone'] == $this->_arrParam['form']['phone']
		&&	$userProfile['fullname'] == $this->_arrParam['form']['fullname']
		&&	$this->_arrParam['form']['password'] == ''
		){
			Session::set('message',array('color'=>'warning','content'=>'Dữ liệu của bạn không có gì thay đổi!'));
			$this->_view->arrparam = $this->_arrParam;
			$this->_view->render('user/index', true);
			exit("---Dung dong lenh tai day!---");
		}
		// exit();
		// exit();
		$queryUserName 		= "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '".$this->_arrParam['form']['username']."'";
		$queryEmail 		= "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '".$this->_arrParam['form']['email']."'";
		$queryphone 		= "SELECT `id` FROM `".TBL_USER."` WHERE `phone` = '".$this->_arrParam['form']['phone']."'";
		if(isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token']>0 ){
			$queryUserName 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
			$queryEmail 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
			$queryphone 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
		}
		
		$validate = new Validate($this->_arrParam['form']);
		$validate	->addRule('username','string-notexistRecord',array('database' => $this->_model, 'query'=> $queryUserName, 'min'=> 6, 'max' => '255'))
					->addRule('phone', 'phone-notexistRecord', array('database' => $this->_model, 'query'=> $queryphone))
					->addRule('email', 'email-notexistRecord', array('database' => $this->_model, 'query'=> $queryEmail))
					->addRule('password', 'password', array('action' =>'edit'),false);
		$validate->run();
		
		$this->_view->arrParam['form'] = $validate->getResult();

		if($validate->isValid()==false){
			$this->_view->errors = $validate->getError();
		}else{
			$this->_view->arrParam['id'] = $this->_arrParam['form']['id'];
			$this->_model->saveItems($this->_view->arrParam,array('task'=>'edit'));
		}
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render('user/index');
	}


}