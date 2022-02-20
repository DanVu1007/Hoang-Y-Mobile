<?php
class IndexController extends Controller{
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
		$this->_view->_title = "Hoàng Ý - Admin";

		$this->_view->render('index/index');
	}
	
	public function loginAction(){
		$userInfo 	= Session::get('user');//GET SESSION INFO
		// exit();

		// exit();
		//CHECK LOGGED
		if ( isset($userInfo) && $userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
			URL::redirect(URL::createURL('admin','index','index'));
		}


		$this->_templateObj->setFileTemplate('login.php');
		$this->_templateObj->load();
		$this->_view->_title = "Đăng nhập admin";



		// exit();
		if(isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token'] > 0){
			$validate 	= new Validate($this->_arrParam['form']);
			$email		= $this->_arrParam['form']['email'];
			$password	= md5($this->_arrParam['form']['password']);

			$query 		= "SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'";

			$validate->addRule('email','existRecord',array('database'=>$this->_model,'query'=>$query));
			$validate->run();

			if($validate->isValid()==true){
				$infoUser = $this->_model->infoItem($this->_arrParam);
				$arraySession = array(
										'login' 	=> true,
										'info'		=> $infoUser,
										'time'		=> time(),
										'group_acp'	=> $infoUser['group_acp']
									);
				Session::set('user',$arraySession);
				if($infoUser['group_acp'] == 1){
					URL::redirect(URL::createURL('admin','index','index'));
				}else{
					URL::redirect(URL::createURL('default','index','index'));
				}
			}else{
				$this->_view->errors = $validate->getError();
			}
		};
		$this->_view->render('index/login');

	}

	public function logoutAction(){
		Session::delete('user');
		URL::redirect(URL::createURL('admin','index','login'));
	}

	public function profileAction(){
		$profileId 		= Session::get('user')['info']['id'];
		$userProfile 	= $this->_model->infoItem($profileId,'showinfo');

		$this->_view->_title = "Thông tin Admin: ".$userProfile['fullname']."";
		$this->_view->arrparam['form'] = $userProfile;
		$this->_view->render('index/profile');
	}

	public function updateprofileAction(){
		$profileId 		= Session::get('user')['info']['id'];
		$userProfile 	= $this->_model->infoItem($profileId,'showinfo');
		if(		$userProfile['username'] == $this->_arrParam['form']['username'] 
			&&	$userProfile['email'] == $this->_arrParam['form']['email']
			&&	$userProfile['phone'] == $this->_arrParam['form']['phone']
			&&	$userProfile['fullname'] == $this->_arrParam['form']['fullname']
			&&	$this->_arrParam['form']['password'] == ''
		){
			$this->_view->errors = 'Dữ liệu của bạn không có gì thay đổi!';
			$this->_view->arrparam = $this->_arrParam;
			$this->_view->render('index/profile', true);
			exit("---Dung dong lenh tai day!---");
		}

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
			$this->_view->errors = $validate->showErrors();
		}else{
			$this->_view->arrParam['id'] = $this->_arrParam['form']['id'];
			$this->_model->saveItems($this->_view->arrParam,array('task'=>'edit'));
		}
		$this->_view->arrparam = $this->_arrParam;
		$this->_view->render('index/profile', true);
		
	}
}