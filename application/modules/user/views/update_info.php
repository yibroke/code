<script>
    $(function(){
        $('#month').change(function(){
            console.log('change month');
        });// end change month.
        $('#day').change(function(){
           console.log('change day');
        });// end change day
        $('#year').change(function(){
           console.log('change year');
        });// end change year.
        $('#form_update_infomation').submit(function(e){
            e.preventDefault();
             var m=$('#month').val();
              var d=$('#day').val();
                var y=$('#year').val();
                var gender=$('.gender:checked').val();
               
            $.ajax({
                url:base_url+'user/update_validation',
                 type:'POST',
                 data:{
                user_name:$('#user_name').val(),
                user_email:$('#user_email').val(),
                age:y+'-'+m+'-'+d,
                country:$('#country').val(),
                gender:gender,
                //gender:$('#gender').val(),
                user_about:$('#user_about').val(),
                user_id:$('#user_id').val()
               },
                beforeSend: function () {
                    $('#load').show();
                },
               complete: function ( ) {
                      $('#load').hide();
              },
               error: function () {
                    alert(0);
                },
               success:function(data)
               {
                 window.location.href =data;
               }
           });// end ajax
        });// end form submit
    });//end ready
</script>
<div class="container">
<h1>Update Information </h1>
 <?php echo form_open('user/update_validation', array('id' => 'form_update_infomation', 'role' => 'form','novalidate' => '')); ?>
<input type="hidden" readonly="readonly" value="<?php echo $query->user_id; ?>" name="user_id" id="user_id">
     <div class="form-group">
        <label for="text">이름:</label>
        <input style="max-width: 500px;" type="text" required="required" class="form-control" name="user_name" id="user_name" value="<?php echo $query->user_name; ?>">
    </div>   
<input type="hidden" readonly="readonly" required="required" class="form-control" name="user_email" id="user_email"value="<?php echo $query->user_email; ?>">
   
     <div class="form-group">
         <?php 
        // echo $query->age;
         if($query->age!='' ||$query->age!=NULL)
         {
             $time = strtotime($query->age);
                $year= date('Y', $time);
                $month= date('m', $time);
                $day= date('d', $time);
         }else{
                $year= '';
                $month= '';
                $day= '';
         }
         ?><br>
        <label for="text">생년월일:</label>
    <select id="month" name="month">
        <option value="">선택 달</option> 
        <option <?php if($month=='01'){  echo 'selected="selected"';} ?> value="01">일월</option> 
        <option <?php if($month=='02'){  echo 'selected="selected"';} ?> value="02">이월</option>
        <option  <?php if($month=='03'){  echo 'selected="selected"';} ?>value="03">삼월</option>
        <option  <?php if($month=='04'){  echo 'selected="selected"';} ?>value="04">사월</option>
        <option  <?php if($month=='05'){  echo 'selected="selected"';} ?>value="05">오월</option>
        <option <?php if($month=='06'){  echo 'selected="selected"';} ?> value="06">유월</option>
        <option <?php if($month=='07'){  echo 'selected="selected"';} ?> value="07">칠월</option>
        <option  <?php if($month=='08'){  echo 'selected="selected"';} ?>value="08">팔월</option>
        <option <?php if($month=='09'){  echo 'selected="selected"';} ?> value="09">구월</option>
        <option  <?php if($month=='10'){  echo 'selected="selected"';} ?>value="10">시월</option>
        <option  <?php if($month=='11'){  echo 'selected="selected"';} ?>value="11">십일월</option>
        <option  <?php if($month=='12'){  echo 'selected="selected"';} ?>value="12">십이월</option>
    </select>
    <select id="day" name="day">
        <option value="">선택 일</option>
        
        <option <?php if($day=='01'){  echo 'selected="selected"';} ?> value="01">1</option>
        <option <?php if($day=='02'){  echo 'selected="selected"';} ?> value="02">2</option>
        <option <?php if($day=='03'){  echo 'selected="selected"';} ?> value="03">3</option>
        <option <?php if($day=='04'){  echo 'selected="selected"';} ?>value="04">4</option>
        <option <?php if($day=='05'){  echo 'selected="selected"';} ?>value="05">5</option>
        <option <?php if($day=='06'){  echo 'selected="selected"';} ?>value="06">6</option>
        <option <?php if($day=='07'){  echo 'selected="selected"';} ?>value="07">7</option>
        <option <?php if($day=='08'){  echo 'selected="selected"';} ?>value="08">8</option>
        <option <?php if($day=='09'){  echo 'selected="selected"';} ?>value="09">9</option>
        <option <?php if($day=='10'){  echo 'selected="selected"';} ?>value="10">10</option>
        <option <?php if($day=='11'){  echo 'selected="selected"';} ?>value="11">11</option>
        <option <?php if($day=='12'){  echo 'selected="selected"';} ?>value="12">12</option>
        <option <?php if($day=='13'){  echo 'selected="selected"';} ?>value="13">13</option>
        <option <?php if($day=='14'){  echo 'selected="selected"';} ?>value="14">14</option>
        <option <?php if($day=='15'){  echo 'selected="selected"';} ?>value="15">15</option>
        <option <?php if($day=='16'){  echo 'selected="selected"';} ?>value="16">16</option>
        <option <?php if($day=='17'){  echo 'selected="selected"';} ?>value="17">17</option>
        <option <?php if($day=='18'){  echo 'selected="selected"';} ?>value="18">18</option>
        <option <?php if($day=='19'){  echo 'selected="selected"';} ?>value="19">19</option>
        <option <?php if($day=='20'){  echo 'selected="selected"';} ?>value="20">20</option>
        <option <?php if($day=='21'){  echo 'selected="selected"';} ?>value="21">21</option>
        <option <?php if($day=='22'){  echo 'selected="selected"';} ?>value="22">22</option>
        <option <?php if($day=='23'){  echo 'selected="selected"';} ?>value="23">23</option>
        <option <?php if($day=='24'){  echo 'selected="selected"';} ?>value="24">24</option>
        <option <?php if($day=='25'){  echo 'selected="selected"';} ?>value="25">25</option>
        <option <?php if($day=='26'){  echo 'selected="selected"';} ?>value="26">26</option>
        <option <?php if($day=='27'){  echo 'selected="selected"';} ?>value="27">27</option>
        <option <?php if($day=='28'){  echo 'selected="selected"';} ?>value="28">28</option>
        <option <?php if($day=='29'){  echo 'selected="selected"';} ?>value="29">29</option>
        <option <?php if($day=='30'){  echo 'selected="selected"';} ?>value="30">30</option>
        <option <?php if($day=='31'){  echo 'selected="selected"';} ?>value="31">31</option>
    </select>
   <select id="year" name="year">
       <option value="">선택 년</option>
       <?php
       for($i=1900;$i<2010;$i++)
       {
           ?>
                 <option <?php if($year==$i){  echo 'selected="selected"';} ?> value='<?php echo $i; ?>'><?php echo $i; ?></option>;
            <?php
       }
       ?>
</select>
    </div> 
<input type="hidden" required="required" class="form-control" name="country" id="country" value="Korea">
     <div class="form-group">
         <label class="radio-inline"><input class="gender" type="radio" <?php if($query->gender=='m'){  echo 'checked="checked"';} ?> name="gender" value="m">남성</label>
         <label class="radio-inline"><input class="gender" type="radio" <?php if($query->gender=='f'){  echo 'checked="checked"';} ?> name="gender" value="f">여자</label>
    </div> 
    <div class="form-group">
  <label for="comment">나에 대해서:</label>
  <textarea class="form-control" rows="5" name="user_about" id="user_about"><?php echo $query->user_about; ?></textarea>
</div>
       <button type="submit" class="btn btn-success">투표</button>
<?php echo form_close(); ?>
<div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
</div>