
   <h1>Insert Search keyword</h1>
            
            
             <!-- Open form -->
            <?php 
            //noted the .$update_id. Can be empty if insert and can be a number if edit. 
            echo form_open('quick_search/insert_validation/'.$update_id, array('id' => 'form_ia11', 'role' => 'form')); 
           // If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
            if(isset($update_id)){?>
         <input type="text" readonly="readonly" value="<?php echo $update_id; ?>" name="id" id="id">
            <?php
            }
            ?>
            <div class="form-group">
                <label>Keyword</label>
                <input type="text" class="form-control" id="ia1" name="name" placeholder="keywrod" required="required" value="<?php echo $name;?>">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            <?php echo form_close(); ?>
            
         