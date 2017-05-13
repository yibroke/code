<style>
    .upload_frame{
        display: none;
    }
    .modal-body {
    position: relative;
    overflow-y: auto;
    max-height: 100%;
    padding: 15px;
}
.autoModal.modal .modal-body{
    max-height: 100%;
}
</style>
<script src="<?php echo base_url(); ?>public/include/jquery.Jcrop.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>public/include/upload_crop_image_1.js" type="text/javascript"></script>
<div class="container">
<h1>My account</h1>
<div class="row">
    <br>
<div class="col-md-2">
    <?php
    if($query->user_avatar!='')
    {
        $avatar=$query->user_avatar;
    }else{
        $avatar='img/template/default_profile.jpg';
    }
    ?>
    <a href="" id="photo_container"> <img src="<?php echo base_url().$avatar; ?>"></a>
    <br> <br>
</div><!-- end 2-->
<div class="col-md-8">
    <table class="table">
    <tbody>
       <tr>
            <td> Username</td>
            <td> <?php echo $query->user_name; ?></td>
        </tr>
        <tr>
            <th> Email / ID</th>
            <td> <?php echo $query->user_email; ?></td>
        </tr>
        <tr>
            <th>Gender </th>
            <?php 
            if($query->gender=='f')
            {
                $gender='Female';
            }else if($query->gender=='m')
            {
                $gender='Male';
            }else
            {
                $gender='Please update gender';
            }
            ?>
            <td>  <?php  echo $gender;?></td>
        </tr>

        <tr>
            <th> Date join</th>
            <td> <?php echo  $this->time_ago->convert_time_ago($query->user_date); ?></td>
        </tr>
    </tbody>
</table>
  <!--  <a href="<?php echo base_url(); ?>user/update-info" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Update</a> -->
    <a href="<?php echo base_url(); ?>user/change-password" class="btn btn-success"><span class="glyphicon glyphicon-lock"></span> Change password</a>
</div><!-- end 8-->
</div><!-- end row -->
<!-- Modal UPLOAD IMAGE -->
<div id="myModalUpload" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">사진 올리기</h4>
            </div>
            <div class="modal-body">
              
                <?php echo form_open_multipart('image/do_upload_image_avatar', array('id' => 'form_upload_image','role' => 'form','target'=>'upload_frame','onsubmit'=>'submit_photo()')); ?>
                   
 
      <input type="file" name="userfile" id="userfile" size="20" />
   
  

        <br /><br />
  <div id="loading_progress"></div>
    
        <button type="submit" class="btn btn-success"> 사진 올리기</button>
        <?php  echo form_close(); ?> 
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
            </div>
        </div>

    </div>
</div>
 <iframe name="upload_frame" class="upload_frame"></iframe> 
<!-- END MODAL -->
<!-- Modal UPLOAD CROP -->
<div id="myModalCrop" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-crop">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button id="mysubmit_crop_avatar" class="btn btn-success"><i class="fa fa-crop"></i>이미지 자르기</button> <!-- button here-->
            </div>
            <div class="modal-body">
                 <!-- This is the image we're attaching the crop to -->
          <img class="img-responsive" id="cropbox" />
          <form id="form_crop_image">
 
              <input type="hidden" name="img_name" id="img_name" value="">
    
    <input type="hidden" name="x" id="x" value="">
    
    <input type="hidden" name="y" id="y" value="">
    
    <input type="hidden" name="h" id="h" value="">
    
    <input type="hidden" name="w" id="w" value="">
    <br>
    <button type="button" class="btn btn-success hidden" onclick="crop_photo()">이미지 자르기</button><!-- hidden this -->
    
     </form>
            </div>
            <div class="modal-footer">
             
            </div>
        </div>

    </div>
</div>
<!-- END MODAL -->

    
</div><!-- end container-->