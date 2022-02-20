<?php 

?>
  <!-- APPLE -->
  <div class="product__category">
      <div class="product__title">
          <h4>
              <a href="#"><?php echo $this->categoryName;?></a>
          </h4>
      </div>
      <div class="product__list">
          <div class="row">
            <?php 
                foreach ($this->items as $value) {
                    $sale = number_format($value['sale_off'] - $value['price']);
                    $image= UPLOAD_URL.'product/'.$value['picture'];

                    $realprice      = ($sale > 0) ? $sale.'đ' : '';
                    $hotPriceImg    = ($sale > 0) ? PUBLIC_URL_DEFAULT.'/imgmain/icon/gia-soc.png' : '';

                    $url = URL::createURL('defaul','product','detail',array('product_id' =>$value['id'] ))
            ?>  
            <!-- TUNG SAN PHAM -->
              <div class="col l-2-4 m-4 c-6 product__item_hover">
                  <div class="product__item">
                      <div class="img">
                          <a href="<?php echo $url  ?>">
                              <img src="<?php echo $image ?>" alt="">
                          </a>
                      </div>
                      <div class="striker striker-left">
                          
                          <!-- NẾU LÀ IPHONE MỚI CÓ DÒNG NÀY - TẠM THỜI CHƯA CÓ PAREND_ID NÊN CHƯA ĐỔ -->
                          <!-- <span>
                              <img src="<?php //echo PUBLIC_URL_DEFAULT ?>/imgmain/icon/apple.png" alt="">
                          </span> -->

                          <span>
                              <img src="<?php echo $hotPriceImg ?>" alt="">
                          </span>
                      </div>
                      <div class="sales">
                          <i class="fas fa-bolt"></i> <span>Giảm <?php echo $sale;?> đ</span> 
                      </div>
                      <div class="info">
                          <a href="<?php echo $url  ?>">
                            <?php echo $value['name'];?>
                          </a>
                          <div class="price">
                              <strong><?php echo number_format($value['price']);?> đ</strong>
                              <span><?php echo $realprice ;?> </span>
                          </div>
                      </div>
                      <div class="note">
                          <a href="" class="note_buynow">Mua ngay</a>
                          <a href="" class="not_addtocart"><i class="fas fa-cart-plus"></i></a>
                      </div>
                      <!-- <div class="promote">
                          <div class="promote__list">
                              <div class="promote__item">
                                  <span>KM</span> Giảm thêm 1.000.000.000 đ khi thu cũ...
                              </div>
                              <div class="promote__item">
                                  <span>KM</span> Giảm thêm 1.000.000.000 đ khi thu cũ...
                              </div>
                          </div>
                      </div> -->
                  </div>
              </div>
            <?php 
                };
            ?>
          </div>
      </div>
  </div>
  <!-- End Apple -->

  <!-- <div class="align-center-box">
     <?php
        // echo( $paginationHTML     = $this->pagination->showPagination(URL::createURL('admin','category','index')));
     ?>
 </div> -->