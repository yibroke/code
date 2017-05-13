<div class="container">

    <div class="row">
        <div class="col-md-9">
		<br>

                     <div class="page-header">
                <h1>Categories</h1>

            </div>
            
            <?php
            foreach ($query as $category) {
                ?>
                <div class="list-group-item">
                <img class="img-rounded" width="70" height="70" src="<?php echo base_url().'img/template/'.$category->icon; ?>">
                <a href="<?php echo base_url().'category/cate/'.$category->id; ?>" ><?php echo $category->cat_name; ?> </a>
                <span> <?php echo $category->count_topic;  ?> topics</span>
               
                </div>
                    <?php
            }
            ?>

          
            <!--end category list group -->
            
        </div>
        <div class="col-md-3">
            <div class="page-header">
                <h1>News topic</h1>

            </div>
            <div class="list-group">
                <?php
            foreach ($news_topic as $topic) {
                ?>
                <div class="list-group-item">
                    
                    <a href="<?php echo base_url().'read/'.url_title($topic->topic_name, '-', TRUE).'/'.$topic->id; ?>" ><?php echo $topic->topic_name; ?></a><br>
					<h5><small"><?php echo $this->time_ago->convert_time_ago($topic->topic_date); ?></small></h5>
                 
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </div>


</div>
