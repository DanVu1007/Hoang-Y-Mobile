
<?php
  // echo '<pre>';
  // print_r();
  // echo '</pre>';
  echo '<title>'.$this->_title.'</title>';
  include_once 'html/header.php';
  require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
  include_once 'html/footer.php';
?>
