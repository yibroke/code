
<div class="list_rep" style="margin-left: 100px;margin-top: 10px;">
                        <div class="comment_content">
                            <p><strong><?php echo $row->user_name; ?></strong> <span class="text-muted small"> <?php  echo $this->time_ago->convert_time_ago($row->date);  ?></span>
                   
                         <a href="#" onclick="doConfirm_reply('<?php echo $row->id; ?>')"><span class="glyphicon glyphicon-trash"></span></a>
                      
                    </p>
                    <?php
               echo $row->reply;
               echo '<br>';
               echo '<br>';
               ?>
                 </div>   
           </div>
            <!-- complain form-->
            
