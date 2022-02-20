<?php
class ProductController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	 
	//INDEX -
	public function listAction(){
		$this->_view->_title = 'Danh sách';
		$this->_view->categoryName	= $this->_model->infoItem($this->_arrParam,array('task'=>'get-category-name'));

		//đếm tổng phần tử
		$totalItems = $this->_model->countItems($this->_arrParam, null);

		//SET UP PAGINATION
		$arrConfig = array('totalItemsPerPage' =>10,'pageRange'=>5);
		$this->setPagination($arrConfig);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
		
		//hiển thị theo parram

		$this->_view->items = $this->_model->listItems($this->_arrParam,array('task'=>'product-in-category'));

		// exit();
		$this->_view->render('product/list', true);
	}



}