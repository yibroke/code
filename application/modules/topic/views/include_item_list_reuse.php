
<?php 
       foreach ($query as $row) {
          

           $title=$this->url_seo->khong_dau($row->name);
          // echo $title;
           $detail=  base_url().'items/detail/'.url_title($title).'/'.$row->id;
            ?>
 <div class = "col-xs-12 col-sm-4 col-md-3 col-lg-2 thumbnail_cover">
     <div class="classWithPad">
    <div class = "thumbnail">
                  <?php
              if($row->price_before!=0)
                {
            ?>
        <span style="background-color: #00dd1c; border-radius: 3px;"> <?php echo '-'.number_format($row->price_before-$row->price);  ?><sup><?php echo lang('currency'); ?></sup></span>
           <?php
                }
           ?>
        <a href="<?php echo $detail; ?>"> <img width="210" height="210" data-src="<?php echo base_url().$row->thumb; ?>" class="lazyload" alt = "<?php echo $row->name; ?>"></a>
    </div>
    <div class = "caption text-center">
        <a href="<?php echo $detail; ?>"><strong><?php echo word_limiter($row->name, 20, '...');?></strong></a>
        <p class="text-danger">
            <strong class="money"><?php echo $price.'<sup>'.lang('currency'); ?></sup></strong> 
                <strong class="small text-muted"><strike><?php echo $before_price; ?></strike></strong>
        </p>
    </div><!-- end caption -->
    </div><!--classWithpad -->
   </div>
 <?php
}
        