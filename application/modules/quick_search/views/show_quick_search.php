<div class="container-fluid well"> 
    
    <div class="container">
        <span class="glyphicon glyphicon-tags"></span>  Quick search:
<?php
    foreach ($records as $record) {
          $edit = base_url() . 'quick_search/insert-quick_search/' . $record->id;
          $detail=  base_url() . 'quick_search/detail/'.url_title($record->name, '-', TRUE).'/' . $record->id;
        ?>
    <a href="<?php echo base_url().'items/tim-kiem?search='.$record->name; ?>" class="btn btn-default"> <?php echo $record->name; ?></a>
        <?php
}
?>
    </div>
</div>                    