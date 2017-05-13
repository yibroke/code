 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/include/highlight/styles/hybrid.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>public/include/highlight/styles/hybrid.css">
<script src="<?php echo base_url(); ?>public/include/highlight/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<div class="container">

    <div class="row">
        <div class="page-header text-center"><h1><?php echo $read_topic->topic_name; ?></h1>
		<?php echo $this->time_ago->convert_time_ago($read_topic->topic_date); ?>
		
		</div>
		
        <div class="col-md-1 thumbnail"><!-- writer infomation-->
            <p class="text-center well red"><?php echo $read_topic->user_name; ?></p>
           
            <p class="text-center"> 

                <?php
                if ($this->time_ago->convert_time_ago($read_topic->user_last_seen) == 'just now') {
                    echo 'Online';
                } else {
                    echo $this->time_ago->convert_time_ago($read_topic->user_last_seen);
                }
                ?>
            </p>
        </div>
        <div class="col-md-11"><!-- topic infomation-->
            
           
                <?php
                //if exist session and session id= writer id show edit link.
                
                if ($this->session->userdata('logged_in') == TRUE) {
                    if($this->session->userdata('user_id')==$read_topic->topic_by)
                    {
                      ?>
            <a href="<?php echo base_url().'/topic/insert/'.$read_topic->id; ?>">Edit</a>
            <?php
                    }
                }
                ?>
            <?php echo $read_topic->topic_content; ?>
           
        </div>

    </div>
    <hr>
    
    <!-- End Topic Detail -->
<?php
if ($this->session->userdata('logged_in') == TRUE) {
    ?>
    <!-- comment-->
  
        <div class="row">
             <div class="col-md-1 thumbnail"><!-- writer infomation-->
            <p class="text-center well red"><?php echo $read_topic->user_name; ?></p>
           
            <p class="text-center"> 

                <?php
                if ($this->time_ago->convert_time_ago($read_topic->user_last_seen) == 'just now') {
                    echo 'Online';
                } else {
                    echo $this->time_ago->convert_time_ago($read_topic->user_last_seen);
                }
                ?>
            </p>
        </div>
            <div class="col-md-11">
                <div id="myerror1"></div>
    <?php echo form_open('comment/comment_validation', array('id' => 'form_post_comment', 'role' => 'form')); ?>
                <input type="hidden" value="<?php echo $read_topic->id ?>" name="topic_id" id="topic_id">
                <div class="form-group">
                    <label for="Content">Content: <?php echo form_error('content'); ?></label>
                    <textarea name="content" class="form-control ckeditor" id="content"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <div id="load" class="glyphicon glyphicon-refresh spinning"> Loading...</div>
    <?php echo form_close(); ?>
            </div>
        </div>
  
    <hr>
    <!-- end form post comment-->
    <?php
}
?>
    <ol id="update" class="timeline"></ol>
    <!-- print all comments-->
<?php
foreach ($topic_comments as $topic_comment) {
    ?>
    

        <div class="row">
            <div class="col-md-1 thumbnail">
                <p class="text-center well red"><?php echo $topic_comment->user_name; ?></p>
              

                <p class="text-center"> 

                    <?php
                    if ($this->time_ago->convert_time_ago($topic_comment->user_last_seen) == 'just now') {
                        echo 'Online';
                    } else {
                        echo $this->time_ago->convert_time_ago($topic_comment->user_last_seen);
                    }
                    ?>
                </p>
            </div>
            <div class="col-md-11">
    <?php echo $topic_comment->comment_content; ?>

            </div>
        </div>
    
    <?php
    echo "<hr>";
}
?>
</div><!-- end container -->

<script src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>



           




