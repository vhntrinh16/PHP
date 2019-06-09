
<div class="kt-product-tab kt-tab-fadeeffect margin-top-5">
    <ul class="nav-tab">
        <li class="active"><a data-animated="fadeInUp" data-toggle="tab" href="#tab-50">Mới Nhất</a></li>
        <li><a data-animated="fadeInUp" data-toggle="tab" href="#tab-51">Giảm Giá</a></li>

    </ul>
    <div class="tab-container">
        <div id="tab-50" class="tab-panel active">
            <div class="owl-carousel nav-center nav-style-1">
                <ul style="width: 1450px;">
                <?php foreach ($product_news as $row): ?>
                    <li class="product-item style9" style="float: left; width: 28%;">
                        <div class="product-inner">
                            <div class="thumb col-sm-5">
                                <a href="<?php echo base_url('chi-tiet-san-pham/'.seoname($row->name_catalog).'/'.seoname($row->name).'/'.$row->id_product) ?>">
                                    <img style="width: 150px; height: 184px;" src="<?php echo base_url('upload'); ?>/products/<?php echo $row->image_link; ?>" alt="<?php echo $row->site_title; ?>">
                                </a>
                            </div>
                            <div class="info col-sm-7">
                                <h3 class="product-name short"><a title="<?php echo $row->site_title; ?>" href="<?php echo base_url('chi-tiet-san-pham/'.seoname($row->name_catalog).'/'.seoname($row->name).'/'.$row->id_product) ?>"><?php echo $row->name; ?></a></h3>
                                <div title="Rated 3 out of 5" class="rating">
                                    <i class="active fa fa-star"></i>
                                    <i class="active fa fa-star"></i>
                                    <i class="active fa fa-star"></i>
                                    <i class="active fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <?php if($row->discount > 0){ ?>
                                <div style="width: 100%;">
                                    <i class="price" style="font-size: 14px; color: #800000; float: left; padding-right: 8px;"><?php echo number_format($row->price - $row->discount); ?> VNĐ</i>
                                    <i class="price" style="color: #666666; text-decoration: line-through;"><?php echo number_format($row->price); ?> VNĐ</i>
                                </div>
                                    <?php }else{ ?>
                                <span class="price" style="font-size: 14px; color: #800000; "><?php echo number_format($row->price - $row->discount); ?> VNĐ</span>
                                <?php }?>
                                <div class="group-buttons">
                                    <a class="button add_to_cart_button" href="<?php echo base_url('cart/add/'.$row->id_product); ?>">Thêm Vào Giỏ Hàng</a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
            <div class="pagination" >
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>

        <div id="tab-51" class="tab-panel">
            <div class="owl-carousel nav-center nav-style-1">
                <ul style="width: 1450px;">
                    <?php foreach ($product_sale as $row): ?>
                        <li class="product-item style9" style="float: left; width: 27%;">
                            <div class="product-inner">
                                <div class="thumb col-sm-5">
                                    <a href="<?php echo base_url('chi-tiet-san-pham/'.seoname($row->name_catalog).'/'.seoname($row->name).'/'.$row->id_product) ?>">
                                        <img style="width: 150px; height: 184px;" src="<?php echo base_url('upload'); ?>/products/<?php echo $row->image_link; ?>" alt="<?php echo $row->site_title; ?>">
                                    </a>
                                </div>
                                <div class="info col-sm-7">
                                    <h3 class="product-name short"><a title="<?php echo $row->site_title; ?>" href="<?php echo base_url('chi-tiet-san-pham/'.seoname($row->name_catalog).'/'.seoname($row->name).'/'.$row->id_product) ?>"><?php echo $row->name; ?></a></h3>
                                    <div class="rating" title="Rated 3 out of 5">
                                        <i class="active fa fa-star"></i>
                                        <i class="active fa fa-star"></i>
                                        <i class="active fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="price" style="font-size: 14px; float: left; padding-right: 8px  ;color: #800000;"><?php echo number_format($row->price - $row->discount); ?> VNĐ</span>
                                    <span class="price" style="font-size: 14px;text-decoration: line-through; color: #666666; "><?php echo number_format($row->price); ?> VNĐ</span>
                                    <div class="group-buttons">
                                        <a class="button add_to_cart_button" href="<?php echo base_url('cart/add/'.$row->id_product); ?>">Thêm Vào Giỏ Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
           
        </div>


    </div>
</div>
