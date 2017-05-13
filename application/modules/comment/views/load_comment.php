  <?php
        foreach ($query as $row) {
                ?>
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
                        if(($user_id==$row->fk_user_id)or($user_id==$owner)and($owner!=1))//same commentor, same owner but owner not guess(guess cant be owner)
                        {
                            ?>
                         <a href="#" onclick="doConfirm('<?php echo $row->comment_id; ?>')"><button class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-trash"></span></button></a>
                        <?php
                        }
                        ?>
                    </p>
                    <?php echo $row->comment_content; ?>
                    <br>
                       <?php
                     $this->load->module('reply');//module
                     $this->reply->list_reply($row->comment_id);//funciton                 
                    ?>
                     <!-- APPEN NEW REPLY -->
                    <ol id="update_rep" class="timeline"></ol>
                     <ul>
                        <li style="margin-left: 60px">
                             <?php
                                if($user_id==1)
                                {
                                    ?>
                                <a href="" class="call-modal-login" data-toggle="modal"><span class="glyphicon glyphicon-share-alt"></span><?php echo lang('reply'); ?></a>
                                <?php
                                }else{
                                    ?>
                                
                                <a href="#" data-reply="<?php echo $row->comment_id; ?>" class="reply-link" ><span class="glyphicon glyphicon-share-alt"></span> <?php echo lang('reply'); ?></a>
                              <?php
                                }
                            ?>
                                <div id="<?php echo 'my_reply_error'.$row->comment_id; ?>"></div>
                                <div class="load" id="<?php echo 'reply_load'.$row->comment_id; ?>"> <button class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
                             <!-- REPLY FORM -->    
                             <div class="wra-comment<?php echo $row->comment_id; ?>" style="display: none;">
                                 <input type="hidden" id="main_id" value="<?php echo $row->fk_question_id; ?>">
                                 <textarea id="reply_content<?php echo $row->comment_id; ?>" rows="2" placeholder="<?php echo lang('content'); ?>" cols="70"></textarea>  
                                 <br>
                                 <a data-button="<?php echo $row->comment_id; ?>" class="btn btn-success btn-xs send-reply"><?php echo lang('reply'); ?></a> 
			     </div>
                        </li>
                    </ul>
                    <br>
                   
                    </div>
                    <hr>
                    <?php
                    }
