<div class="container">
    <div class="row">
        <br>
        <div class="col-xs-6 well">
<?php
foreach ($query as $row)
{
    if($row->module==1)
    {
        $module='items/detail/';
         $title=$this->url_seo->khong_dau($row->name);
       // echo $title;
      $detail=  base_url().$module.url_title($title).'/'.$row->main_id;
      $name=$row->name;
    }else{
        $module='order/detail/';
        $detail=  base_url().$module.$row->main_id;
      $name= 'Yeah!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
    }
    ?>
     <a target="_blank" href="<?php echo $detail; ?>"><p><strong><?php echo $name; ?></strong></p></a>
     <h6 class="pull-right"><?php echo $this->time_ago->convert_time_ago($row->date); ?></h6>
     <p><?php echo $row->title;  ?> </p>
  <hr>
<?php
}
?></div>
      </div>
</div>
