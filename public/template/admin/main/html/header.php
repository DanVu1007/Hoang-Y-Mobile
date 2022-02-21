<?php 
    $logout = URL::createURL('admin','index','logout');
    $profile = URL::createURL('admin','index','profile');
    $name   = !empty(Session::get('user')) ? 'Chào '.Session::get('user')['info']['fullname'] : 'Hi Admin Manager';
?>
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
      <?php echo $this->_cssFiles;?>
      <link rel="icon" href="<?php echo PUBLIC_URL ?>/template/admin/main/images/logohoangy.png" type="image/icon type">
      <link rel="stylesheet" href="<?php echo PUBLIC_URL ?>/template/admin/main/fontawesome-free-5.15.4-web/css/all.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="http://localhost/HOANGY-MOBILE/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>Y</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Hoàng Ý</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigat1212ion</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <ul class="nav navbar-nav navbar-right" style="margin-right: 10px">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $name ;?><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $profile ;?>">Thông tin</a></li>
            <li><a href="<?php echo $logout ;?>">Thoát tài khoản</a></li>
          </ul>
        </li>
      </ul>

    </nav>
  </header>