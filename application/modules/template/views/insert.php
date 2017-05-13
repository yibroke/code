<script>
$(function(){
  $('#choose_province').change(function(){
     console.log($('#choose_province').val());
        $.ajax({
                url:base_url+'customer/district',
                 type:'POST',
                 data:{
                city:$('#choose_province').val()
               },
               error: function () {
                    alert(0);
                },
               success:function(data)
               {
                   var jsonData = JSON.parse(data);
                  
                    $('#show_district').html(jsonData.view);
                   
               }
           });// end ajax
  }) ;//end select_soft_by change
});//end ready
</script>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Thông tin và địa chỉ giao hàng</h1>
            <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
            <div class="text-success" id="con_message"></div>
          <?php echo form_open('customer/validation', array('id' => 'form_category', 'role' => 'form')); 
                if(isset($update_id)){?>
            <input type="hidden" readonly="readonly" value="<?php echo $update_id; ?>" name="id" id="id">
               <?php
               }else{
                 //  $session_id= session_id();
                    $session_id=md5(uniqid());//just a unique id.
               }
               //order id
               ?>
                    <input type="hidden" class="form-control" name="session_id" id="con_name" required="required" placeholder="Tên Người Nhận" value="<?php echo $session_id; ?>">
            
                <div class="form-group">
                    <label for="comment">Tên :</label>
                    <input type="text" class="form-control" name="name" id="con_name" required="required" placeholder="Tên Người Nhận" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="comment">Email:</label>
                    <input type="email" class="form-control" name="email" id="con_email" required="required"  placeholder="Email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="comment">Phone:</label>
                    <input type="tel" class="form-control" name="phone" id="con_email" required="required"  placeholder="Điện thoại" value="<?php echo $phone; ?>">
                </div>
                <div class="form-group">
                    <label for="comment">Địa Chỉ:</label>
                    <input type="text" class="form-control" name="address" id="con_email" required="required"  placeholder="Địa chỉ" value="<?php echo $address; ?>">
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="comment">Tỉnh/ Thành phố:</label>
                     <select name="city" class="form-control" id="choose_province" required="required">  
                  <option value="">--- Tỉnh / Thành phố ---</option>
                 <?php
                 foreach($provinces as $pro)
                 {
                     ?>
                  <option <?php if($city==$pro->pro_id){ echo 'selected="selected"';} ?> value="<?php echo $pro->pro_id ?>"><?php echo $pro->pro_type.' '.$pro->pro_name; ?></option>
                  <?php
                 }
                 ?>
                  </select>
                    
                            </div>
                        </div><!-- 6-->
                        <div class="col-md-6" id="show_district">
                         <?php 
                          $this->load->module('customer');//module
                          $this->customer->load_district($city,$district);//funciton
                         ?>
                    
                        </div><!-- 6-->
                        
                    </div><!-- end row -->
                    
                <div class="form-group">
                    <label for="comment">Chỉ đường (không bắt buộc):</label>
                    <textarea class="form-control" rows="5" required="required" name="note" id="note"><?php echo $note; ?></textarea>
                </div>
                <h1></h1>
                <button type="submit" class="btn btn-success btn-block">Submit</button>
            <?php echo form_close(); ?>
        </div>
        <div class="col-md-6">
  <?php $this->load->view('order/include_cart'); ?>
    </div><!-- end row -->
</div>
</div>

