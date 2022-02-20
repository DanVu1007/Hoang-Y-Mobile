<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <title>
    <?php echo $this->_title;?>
  </title>
	    <?php echo $this->_metaHTTP;?>
	    <?php echo $this->_metaName;?>

      <link rel="stylesheet" href="<?php echo PUBLIC_URL ?>template/admin/main/css/custom-style.css">
      <link rel="icon" href="<?php echo PUBLIC_URL ?>/template/admin/main/images/logohoangy.png" type="image/icon type">
      <link rel="stylesheet" href="<?php echo PUBLIC_URL ?>/template/admin/main/fontawesome-free-5.15.4-web/css/all.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

            <?php 
            require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
          ?>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->


<script src="<?php echo PUBLIC_URL ?>template/admin/main/js/jquery.min.js"></script>
<script src="<?php echo PUBLIC_URL ?>template/admin/main/js/bootstrap.min.js"></script>
<script src="<?php echo PUBLIC_URL ?>template/admin/main/js/adminlte.min.js"></script>
<script src="<?php echo PUBLIC_URL ?>template/admin/main/js/custom.js"></script>
<script src="<?php echo PUBLIC_URL ?>template/admin/main/js/validate.js"></script>
</body>
</html>
