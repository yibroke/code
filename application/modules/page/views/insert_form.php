<script src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
            <script>

		CKEDITOR.on( 'instanceReady', function( evt ) {
			var editor = evt.editor;
			//editor.setData( '' );

			// Apply focus class name.
			editor.on( 'focus', function() {
				editor.container.addClass( 'cke_focused' );
			});
			editor.on( 'blur', function() {
				editor.container.removeClass( 'cke_focused' );
			});

			// Put startup focus on the first editor in tab order.
			if ( editor.tabIndex == 1 )
				editor.focus();
		});
</script>
<div class="container">
   
<h1>Insert/Edit Page Form</h1>
 <?php 
 //noted the .$update_id. Can be empty if insert and can be a number if edit. 
 echo form_open('page/insert_validation/'.$update_id, array('id' => 'form_insert_page', 'role' => 'form')); 
// If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
   if(isset($update_id)){?>
<input type="text" readonly="readonly" value="<?php echo $update_id; ?>" name="id" id="id">
   <?php
   }
   ?>
  <div class="form-group">
    <label>Headline</label>
    <input type="text" class="form-control" name="headline"  value="<?php echo $page_headline ; //  empty(insert) or value(edit) ?>">
  </div>
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title"  value="<?php echo $page_title;  //  empty(insert) or value(edit)?>">
  </div>
  <div class="form-group">
    <label>Keywords</label>
    <input type="text" class="form-control" name="keywords" value="<?php echo $page_keywords;  //  empty(insert) or value(edit) ?>">
  </div>
  <div class="form-group">
    <label>Description</label>
    <input type="text" class="form-control" name="description" value="<?php echo $page_description;  //  empty(insert) or value(edit) ?>">
  </div>
  <div class="form-group">
    <label>Content</label>
    <textarea class="form-control ckeditor" name="content" id="headline" ><?php echo $page_content;  //  empty(insert) or value(edit) ?></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
 <?php echo form_close(); ?>
  </div>
  
 