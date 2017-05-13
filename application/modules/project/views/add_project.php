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
<br>
<h1>Add project</h1>
<?php 
 //projectd the .$update_id. Can be empty if insert and can be a number if edit. 
 echo form_open('project/insert_validation/'); 
// If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
   if(isset($update_id)){?>
     <input type="hidden" value="<?php echo $update_id; ?>" name="id" id="id">
   <?php
   }
   ?>
 <div class="form-group">
    <label>Name</label>
    <input class="form-control" name="name" id="headline" value="<?php echo $name; ?>" >
  </div>
  <div class="form-group">
    <label>Content</label>
    <textarea class="form-control ckeditor" name="content" id="headline" ><?php echo htmlentities($content, ENT_QUOTES); ?></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
 <?php echo form_close(); ?>