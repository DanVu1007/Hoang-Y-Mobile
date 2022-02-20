<?php
class GroupController extends Controller{
	
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
		$this->_view->_title = 'Quản lý nhóm';
		//đếm tổng phần tử
		$totalItems = $this->_model->countItems($this->_arrParam, null);

		//SET UP PAGINATION
		$arrConfig = array('totalItemsPerPage' =>10,'pageRange'=>5);
		$this->setPagination($arrConfig);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
		
		//hiển thị theo parram
		$this->_view->items = $this->_model->listItems($this->_arrParam,null);

		$this->_view->render('group/index', true);
	}



	public function removeAction(){
		if(isset($this->_arrParam['id'])){
			$this->_model->removeItem($this->_arrParam);
			URL::redirect(URL::createURL('admin','group','index'));
		}
	}
	public function formAction(){
		$this->_view->_title = 'Thêm nội dung';

		// exit();
		//EDIT ITEM
		if(isset($this->_arrParam['id']) && empty($this->_arrParam['edittoken'])){
			$this->_view->_title = 'Thay đổi nội dung';
			$this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam); // lấy dữ liệu từng items
			if(empty($this->_arrParam['form'])) URL::redirect(URL::createURL('admin','group','index')); // nếu không tìm được id hợp lí thì redirect về index
		}
		


		//ADD NEW ITEM
		if((isset($this->_arrParam['form']) && isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token'] > 0) 
		 || ((isset($this->_arrParam['id']) && isset($this->_arrParam['edittoken']) && $this->_arrParam['edittoken'] > 0 )))
		 
		{
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('name','string',array('min' => 3, 'max'=> 255))
			->addRule('ordering', 'int', array('min' => 1, 'max'=>100 ))
			->addRule('status','status',array('deny' =>array('default') ))
			->addRule('group_acp','status',array('deny' =>array('default')));
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid()==false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$task = (isset($this->_arrParam['edittoken'])  ) ? 'edit' : 'add';
				$this->_model->saveItems($this->_arrParam,array('task'=>$task));
			}
		}
		$this->_view->arrparam = $this->_arrParam;
		$this->_view->render('group/form', true);
	}
	public function saveAction(){
		// echo '<h3>' . __METHOD__ . '</h3>';
		$this->_view->_title = 'Save nội dung';
		URL::redirect(URL::createURL('admin','group','index'));
		

	}

	//ORDERING ACTION 					((*))
	public function orderingAction(){  
		// echo '<h3>' . __METHOD__ . '</h3>';
		$this->_model->ordering($this->_arrParam);
		URL::redirect(URL::createURL('admin','group','index'));

	}

	//ACTION: ajax function 			((*))
	public function ajaxStatusAction(){
		$result  = $this->_model->changeStatus($this->_arrParam,array('task' => 'change-ajax-status'));
		echo json_encode($result);
	}

	//ACTION ajax GROUP ACP 			((*))
	public function ajaxACPAction(){
		$result  = $this->_model->changeStatus($this->_arrParam,array('task' => 'change-ajax-group-acp'));
		echo json_encode($result);
	}

	//ACTION CHANGE ALL SATUS			((*))
	public function statusAction(){
		$this->_model->changeStatus($this->_arrParam,array('task' => 'change-status'));
		URL::redirect(URL::createURL('admin','group','index'));
	}

	//ACTION TRASH ALL 					((*))
	public function removeallAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createURL('admin','group','index'));
	}

}