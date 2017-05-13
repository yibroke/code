<?php


echo form_hidden('search',$keyword);


?>
<div class="container">
    <h1><strong class="number"><?php echo $num_result; ?></strong> results for the keyword <?php echo $keyword; ?></h1>
    <?php
    $i=0;
     foreach ($searchs as $search)
     {
          ?>
                <div class="list-group-item">
                    <div class="list-group-item-heading"><a href="<?php echo base_url() . 'read/' . url_title($search->topic_name, '-', TRUE) . '/' . $search->id; ?>"><p> <?php echo $search->topic_name; ?></p></a></div>
                    <?php echo tags_explode($search->topic_tag); ?>
                </div>

    <?php
     }
    
    ?>
    
    
      <div class="text-center">
                <?php  echo $this->pagination->create_links(); ?>
            </div>
    
</div>