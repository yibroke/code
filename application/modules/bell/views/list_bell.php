<div class="container">
    <div class="row">
        <br>
        <div class="col-xs-6 well">
<?php
foreach ($query as $row)
{
    ?>
     <a target="_blank" href="<?php echo base_url().$row->link; ?>"><p><strong><?php echo $row->title; ?></strong></p></a>
    <h6 class="pull-right"><?php echo $this->time_ago->convert_time_ago($row->date); ?></h6>
    <p><?php echo $row->content;  ?> </p>
  <hr>
<?php
   
}
?></div>
      </div>
</div>
