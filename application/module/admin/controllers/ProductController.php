<?php
class ProductController extends Controller{
	
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
		$this->_view->_title = 'Quản lý sản phẩm';
		//đếm tổng phần tử
		$totalItems = $this->_model->countItems($this->_arrParam, null);

		//SET UP PAGINATION
		$arrConfig = array('totalItemsPerPage' =>10,'pageRange'=>5);
		$this->setPagination($arrConfig);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);

 		$this->_view->slbCategory = $this->_model->itemInSelectBox($this->_arrParam,'Tìm kiếm theo nhóm',null);
		$this->_view->items = $this->_model->listItems($this->_arrParam,null); 

		$this->_view->render('product/index', true);
	}


	//EDIT
	public function editAction(){
	}
	public function removeAction(){
		if(isset($this->_arrParam['id'])){
			$this->_model->removeItem($this->_arrParam);
			URL::redirect(URL::createURL('admin','product','index'));
		}
	}
	public function formAction(){
		$this->_view->_title = 'Thêm tài khoản';
		if(!empty($_FILES)) $this->_view->arrParam['form']['picture'] = $_FILES['picture'];

		//EDIT ITEM
		$this->_view->slbCategory  = $this->_model->itemInSelectBox($this->_arrParam,'-Lựa chọn nhóm-',null);
		

		if(isset($this->_arrParam['id'])){
			$this->_view->_title = 'Thay đổi nội dung';
			$this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam); // lấy dữ liệu từng items
			if(empty($this->_arrParam['form'])) URL::redirect(URL::createURL('admin','product','index')); // nếu không tìm được id hợp lí thì redirect về index
		}


		//ADD  ITEM
		if((isset($this->_arrParam['form']) && isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token'] > 0) 
		 || ((isset($this->_arrParam['id']) && isset($this->_arrParam['edittoken']) && $this->_arrParam['edittoken'] > 0 )))
		 
		{
			$task = 'add';
			if(isset($this->_arrParam['edittoken']) && isset($this->_arrParam['form']['id']) ){
				$task 			= 'edit';
			}

			// exit();
			$validate = new Validate($this->_view->arrParam['form']);
			$validate	->addRule('name','string',array('min'=> 6, 'max' => 90))
						->addRule('ordering', 'int', array('min' => 1, 'max'=>100 ))
						->addRule('price', 'int', array('min' => 1000, 'max'=>1000000000 ))
						->addRule('sale_off', 'int', array('min' => 1000, 'max'=>1000000000 ))
						->addRule('picture', 'file', array('min' => 100, 'max'=>10000000,'extension'=>array('jpg','png','JPG','PNG')),false)
						->addRule('status','status',array('deny' =>array('default') ))
						->addRule('special','status',array('deny' =>array('default') ))
						->addRule('category_id','status',array('deny' =>array('default')));
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
		$this->_view->render('product/form', true);
	}
	public function saveAction(){
		// echo '<h3>' . __METHOD__ . '</h3>';
		$this->_view->_title = 'Save nội dung';
		URL::redirect(URL::createURL('admin','product','index'));
		

	}

	//ORDERING ACTION 					((*))
	public function orderingAction(){  
		// echo '<h3>' . __METHOD__ . '</h3>';
		$this->_model->ordering($this->_arrParam);
		URL::redirect(URL::createURL('admin','product','index'));

	}

	//ACTION: ajax function 			((*))
	public function ajaxStatusAction(){
		$result  = $this->_model->changeStatus($this->_arrParam,array('task' => 'change-ajax-status'));
		echo json_encode($result);
	}

	//ACTION: ajaxSpecial			((*))
	public function ajaxSpecialAction(){
		$result  = $this->_model->changeStatus($this->_arrParam,array('task' => 'change-ajax-special'));
		echo json_encode($result);
	}


	//ACTION CHANGE ALL SATUS			((*))
	public function statusAction(){
		$this->_model->changeStatus($this->_arrParam,array('task' => 'change-status'));
		URL::redirect(URL::createURL('admin','product','index'));
	}

	//ACTION TRASH ALL 					((*))
	public function removeallAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createURL('admin','product','index'));
	}

}