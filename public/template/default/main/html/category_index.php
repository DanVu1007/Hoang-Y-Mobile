<?php 
    $model  = new Model();
    $query  = "SELECT `id`, `name`, `parend_id`,`icon` FROM `".TBL_CATEGORY."` WHERE `status` = 1";
    $resultCategory = $model->fetchAll($query);

    // exit();
?>