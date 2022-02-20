<?php
class IndexController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
		$this->_view->_title = 'Hoàng Ý';
		// echo '<pre>';
		// print_r($this);
		// echo '</pre>';

		$this->_view->render('index/index');
	}

	public function noticeAction(){
		$this->_view->_title = 'Thông báo';
		// echo '<pre>';
		// print_r($this);
		// echo '</pre>';

		$this->_view->render('index/notice');
	}
	
	public function loginAction(){

		$userInfo 	= Session::get('user');//GET SESSION INFO
		//CHECK LOGGED
		if ( isset($userInfo) && $userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
			URL::redirect(URL::createURL('admin','index','index'));
		}
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
		$this->_view->action = 'login';
		$this->_view->render('index/register');
	}

	public function logoutAction(){
		Session::delete('user');
		URL::redirect(URL::createURL('default','index','index'));
	}

	public function registerAction(){
		$userInfo 	= Session::get('user');//GET SESSION INFO
		//CHECK LOGGED
		if ( isset($userInfo) && $userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
			URL::redirect(URL::createURL('default','index','index'));
		}


		
		$this->_view->_title = 'Hoàng Ý - Đăng Ký';
		
		if(isset($this->_arrParam['form']['register'])){
			
			//CHECK REFRESH PAGE //khong can vi neu sai thì form validate con neu dung thi form refresh
			// URL::checkRefreshPage($this->_arrParam['form']['token'],'default','user','register');

			//VALIDATE
			$queryUserName 		= "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '".$this->_arrParam['form']['username']."'";
			$queryEmail 		= "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '".$this->_arrParam['form']['email']."'";
			$queryphone 		= "SELECT `id` FROM `".TBL_USER."` WHERE `phone` = '".$this->_arrParam['form']['phone']."'";

			if(isset($this->_arrParam['edittoken']) && isset($this->_arrParam['form']['id']) ){
				$queryUserName 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
				$queryEmail 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
				$queryphone 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
			}
			$validate = new Validate($this->_view->arrParam['form']);
			$validate	->addRule('username','string-notexistRecord',array('database' => $this->_model, 'query'=> $queryUserName, 'min'=> 6, 'max' => '255'))
						->addRule('phone', 'phone-notexistRecord', array('database' => $this->_model, 'query'=> $queryphone))
						->addRule('email', 'email-notexistRecord', array('database' => $this->_model, 'query'=> $queryEmail))
						->addRule('password', 'password', array('action' =>'add'));
			$validate->run();

 			// GET VALUE INPUT IF VALUE IS RIGHT
			$this->_view->arrParam['form'] = $validate->getResult();

			//CHECK ERROR AND SAVE ACCOUNT
			if($validate->isValid()==false){
				$this->_view->errors = $validate->getError();
			}else{
				$this->_model->saveItems($this->_view->arrParam,array('task'=>'user-register'));
				URL::redirect(URL::createURL('default','index','notice',array( 'type' => 'register-success' , )));
			}
		}

		$this->_view->render('index/register');
	}



}