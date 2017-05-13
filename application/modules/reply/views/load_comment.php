  <?php
            foreach ($load_comment as $row) {
                ?>

<li>  

                          <div class="comment_profile pull-left"> 
                           <?php 
                            if($row->user_avatar=='')
                            {
                                $avatar='img/avatar/default_profile.jpg';
                            }else
                            {
                                $avatar=$row->user_avatar;
                            }
                            ?>
                            <img class="img-circle" src="<?php echo base_url().$avatar; ?>">
                        </div>
                         <div class="comment_content">
                              <p><strong><?php echo $row->user_name; ?></strong> <span class="text-muted small"> <?php  echo $this->time_ago->convert_time_ago($row->comment_date);  ?></span>
                        <?php
                          if ($this->session->userdata('logged_in') == TRUE) {
                        $user_id= $this->session->userdata('user_id');
                          }else{
                              $user_id='1';
                          }

                        if($user_id==$row->fk_user_id)
                        {
                            ?>
                         <a href="#" onclick="doConfirm('<?php echo $row->comment_id; ?>')"><button class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-trash"></span></button></a>
                        <?php
                            
                        }
                        ?>
                    </p>
                    <?php echo $row->comment_content; ?>
          
                        </div>
      <hr>
        
                        <?php
                    }
                    ?>
  
</li>

