 <div class="container">

        <div class="row">
            <div class="col-md-1 thumbnail">
                <p class="text-center red"><?php echo $user_comment->user_name; ?></p>
                 <p class="text-center"> 
            
              <?php if($this->time_ago->convert_time_ago($user_comment->user_last_seen)=='just now')
                            {
                                echo 'Online';
                            }
                            else {echo $this->time_ago->convert_time_ago($user_comment->user_last_seen);}
                ?>
            
            
            
            </p>
            
            
            
            </div>
            <div class="col-md-11">
                <?php  echo $new_comment->comment_content; ?>

            </div>

        </div>


    </div>
<hr>