<script src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
<div class="container">
    <h1>Write</h1>
    <hr>
    <div id="myerror1"></div>
    <?php echo form_open('topic/validation', array('id' => 'form_post_topic', 'role' => 'form')); 
// If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
   if(isset($update_id)){?>
<input type="text" readonly="readonly" value="<?php echo $update_id; ?>" name="id" id="id">
   <?php
   }
   ?>
    <div class="form-group">
        <label for="text">Topic Name: <?php echo form_error('name'); ?></label>
        <input type="text" class="form-control" required name="name" value="<?php echo $topic_name; ?>"  id="name">
    </div>


    <div class="form-group">
        <label for="sel1">Select Category: <?php echo form_error('cagegory'); ?></label>
        <select required class="form-control" name="category" id="category">
            <option value="">Please choose a category</option>

            <?php
            foreach ($categories as $cat) {
                ?>

                <option <?php if($cat->id==$topic_cat){ echo 'selected="selected"';} ?> value="<?php echo $cat->id; ?>"><?php echo $cat->cat_name; ?></option>
                <?php
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="Content">Content: <?php echo form_error('content'); ?></label>
        <textarea required name="content" class="form-control ckeditor" id="content"><?php echo htmlentities($topic_content, ENT_QUOTES); ?></textarea>
    </div>

    <div class="form-group">
        <label for="Tags">Tags: <?php echo form_error('tags'); ?></label>
        <input type="text" required class="form-control" value="<?php echo $topic_tag; ?>" data-role="tagsinput" name="tags" id="tags">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
    
    
    <div id="load" class="glyphicon glyphicon-refresh spinning"> Loading...</div>
    
<?php echo form_close(); ?>
    
   





</div>