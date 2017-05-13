<div class="list_rep" style="margin-left: 100px;margin-top: 10px;">
          
            <?php
            foreach ($query1 as $row) {
                 ?>
                
                        <div class="comment_content">
                            <p><strong><?php echo $row->user_name; ?></strong> <span class="text-muted small"> <?php  echo $this->time_ago->convert_time_ago($row->date);  ?></span>
                        <?php
                        if(($user_id==$row->user_reply_id)or($user_id==$owner)and($owner!=1))//same commentor, same owner but owner not guess(guess cant be owner)
                        {
                            ?>
                         <a href="#" onclick="doConfirm_reply('<?php echo $row->id; ?>')"><span class="glyphicon glyphicon-trash"></span></a>
                        <?php
                        }
                        ?>
                    </p>
                    <?php
               echo $row->reply;
               echo '<br>';
               echo '<br>';
               ?>
                 </div>   
            <?php
                    }
              ?>
            <!-- complain form-->
            

</div>