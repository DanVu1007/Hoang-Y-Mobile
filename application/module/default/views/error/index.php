<?php 
	$message = "Không thể tìm thấy trang!";
	$img	 = 'error404.png';
?>
<div class="notice-message">
    <?php echo $message ;?>
    <img src="<?php echo PUBLIC_URL_DEFAULT ?>/imgmain/<?php echo $img ?>" alt="">
</div>