<?php
class CategoryController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	 
	//INDEX -
	public function indexAction(){
		$this->_view->_title = 'Danh sách';
		//đếm tổng phần tử
		$totalItems = $this->_model->countItems($this->_arrParam, null);

		//SET UP PAGINATION
		$arrConfig = array('totalItemsPerPage' =>10,'pageRange'=>5);
		$this->setPagination($arrConfig);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
		
		//hiển thị theo parram

		$this->_view->items = $this->_model->listItems($this->_arrParam,null);

		$this->_view->render('category/index', true);
	}



}