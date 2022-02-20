<?php
class UserController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	//INDEX -
	public function indexAction(){
		// echo '<h3>' . __METHOD__ . '</h3>';
		$this->_view->_title = 'Quản lý tài khoản';
		//đếm tổng phần tử
		$totalItems = $this->_model->countItems($this->_arrParam, null);

		//SET UP PAGINATION
		$arrConfig = array('totalItemsPerPage' =>10,'pageRange'=>5);
		$this->setPagination($arrConfig);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);

		//hiển thị theo parram 
		// echo '<pre>';
		// print_r($this->_arrParam);
		// echo '</pre>';
 		$this->_view->slbGroup = $this->_model->itemInSelectBox($this->_arrParam,'Tìm kiếm theo nhóm',null);
		$this->_view->items = $this->_model->listItems($this->_arrParam,null); 

		$this->_view->render('user/index', true);
	}


	//EDIT
	public function editAction(){
	}
	public function removeAction(){
		if(isset($this->_arrParam['id'])){
			$this->_model->removeItem($this->_arrParam);
			URL::redirect(URL::createURL('admin','user','index'));
		}
	}
	public function formAction(){
		$this->_view->_title = 'Thêm tài khoản';
		//EDIT ITEM
		$this->_view->slbGroup = $this->_model->itemInSelectBox($this->_arrParam,'-Lựa chọn nhóm-',null);
		

		if(isset($this->_arrParam['id'])){
			$this->_view->_title = 'Thay đổi nội dung';
			$this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam); // lấy dữ liệu từng items
			if(empty($this->_arrParam['form'])) URL::redirect(URL::createURL('admin','user','index')); // nếu không tìm được id hợp lí thì redirect về index
		}


		//ADD  ITEM
				// echo '<pre>';
				// print_r($this);
				// echo '</pre>';
		if((isset($this->_arrParam['form']) && isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token'] > 0) 
		 || ((isset($this->_arrParam['id']) && isset($this->_arrParam['edittoken']) && $this->_arrParam['edittoken'] > 0 )))
		 
		{
			$queryUserName 		= "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '".$this->_arrParam['form']['username']."'";
			$queryEmail 		= "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '".$this->_arrParam['form']['email']."'";
			$queryphone 		= "SELECT `id` FROM `".TBL_USER."` WHERE `phone` = '".$this->_arrParam['form']['phone']."'";
			$requirePass 		= true;

			$task = 'add';
			if(isset($this->_arrParam['edittoken']) && isset($this->_arrParam['form']['id']) ){
				$task 			= 'edit';
				$requirePass 	= false;
				$queryUserName 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
				$queryEmail 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
				$queryphone 	.= "AND `id` <> '".$this->_arrParam['form']['id']."'";
			}

			$validate = new Validate($this->_view->arrParam['form']);
			$validate	->addRule('username','string-notexistRecord',array('database' => $this->_model, 'query'=> $queryUserName, 'min'=> 6, 'max' => '255'))
						->addRule('ordering', 'int', array('min' => 1, 'max'=>100 ))
						->addRule('phone', 'phone-notexistRecord', array('database' => $this->_model, 'query'=> $queryphone))
						->addRule('email', 'email-notexistRecord', array('database' => $this->_model, 'query'=> $queryEmail))
						->addRule('password', 'password', array('action' =>$task),$requirePass)
						->addRule('status','status',array('deny' =>array('default') ))
						->addRule('group_id','status',array('deny' =>array('default')));
			$validate->run();
			
			$this->_view->arrParam['form'] = $validate->getResult();
			if($validate->isValid()==false){
				// echo $task;
				$this->_view->errors = $validate->showErrors();
			}else{
				$this->_model->saveItems($this->_view->arrParam,array('task'=>$task));
			}
		}
		if(isset($this->_view->arrParam['form'])){
			$newarr = array_merge($this->_arrParam['form'],$this->_view->arrParam['form']);
			$this->_arrParam['form'] = $newarr;
		}

		$this->_view->arrparam = $this->_arrParam;
		$this->_view->render('user/form', true);
	}
	public function saveAction(){
		// echo '<h3>' . __METHOD__ . '</h3>';
		$this->_view->_title = 'Save nội dung';
		URL::redirect(URL::createURL('admin','user','index'));
		

	}

	//ORDERING ACTION 					((*))
	public function orderingAction(){  
		// echo '<h3>' . __METHOD__ . '</h3>';
		$this->_model->ordering($this->_arrParam);
		URL::redirect(URL::createURL('admin','user','index'));

	}

	//ACTION: ajax function 			((*))
	public function ajaxStatusAction(){
		$result  = $this->_model->changeStatus($this->_arrParam,array('task' => 'change-ajax-status'));
		echo json_encode($result);
	}


	//ACTION CHANGE ALL SATUS			((*))
	public function statusAction(){
		$this->_model->changeStatus($this->_arrParam,array('task' => 'change-status'));
		URL::redirect(URL::createURL('admin','user','index'));
	}

	//ACTION TRASH ALL 					((*))
	public function removeallAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createURL('admin','user','index'));
	}

}