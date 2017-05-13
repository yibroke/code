
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-9">
          
            <ul class="nav nav-tabs ">
                <?php $check = $this->uri->segment(2); ?>
                <li <?php if ($check == 'profile') {
                    echo 'class="active"';
                } ?> ><a href="<?php echo base_url().'user/profile/'.$query->user_id; ?>">윤곽</a></li>
                <li  <?php if ($check == 'activity') {
                    echo 'class="active"';
                } ?>><a href="<?php echo base_url().'user/activity/'.$query->user_id; ?>">투표</a></li>   
            </ul>
            <br>
            <div class="row">
                <!-- profile image-->
                <div class="col-md-3">
                    <?php
                    if($query->user_avatar!='')
                    {
                        $avatar=$query->user_avatar;
                    }else{
                        $avatar='img/template/default_profile.jpg';
                    }
                    $point=$query->user_point;// user point
                    ?>
                    <img class="img-circle" src="<?php echo base_url().$avatar; ?>">
                </div><!-- end col md 3-->
                <div class="col-md-9">
                   <table class="table">
    <tbody>
       <tr>
            <td> 이름</td>
            <td> <?php echo $query->user_name; ?></td>
        </tr>
        <tr>
            <th> 포인트</th>
            <td> <?php  echo $query->user_point; ?></td>   
        </tr>
        <tr>
            <th> Level</th>
            <td> <?php 
            
                 if($point<10000)
                 {
                     echo 'Newbies';
                 }else if($point>10000&&$point<100000)
                 {
                     echo 'Junior';
                     
                 }else if($point>100000&&$point<1000000)
                 {
                     echo 'Senior';
                     
                 }else{
                     echo 'Master';
                 }
            
            
            ?></td>   
        </tr>
        <tr>
            <th> 성별 </th>
            <?php 
            if($query->gender=='f')
            {
                $gender='여자';
            }else if($query->gender=='m')
            {
                $gender='남성';
            }else
            {
                $gender='';
            }
            ?>
            <td>  <?php  echo $gender;?></td>
        </tr>
        <tr>
            <th> 내정보</th>
            <td> <?php echo $query->user_about; ?></td>
        </tr>
        <tr>
            <th> 가입일</th>
            <td> <?php echo  $this->time_ago->convert_time_ago($query->user_date); ?></td>
        </tr>
        <tr>
            <th> 마지막으로 본</th>
            
            <?php
             if ($this->time_ago->convert_time_ago($query->user_last_seen) == '방금') {
                        $last_seen= '<p class="text-success"><strong><i class="fa fa-wifi" aria-hidden="true"></i> 온라인으로</strong></p>';
                    } else {
                        $last_seen= $this->time_ago->convert_time_ago($query->user_last_seen);
                    }   
            ?>
            <td> <?php echo  $last_seen; ?></td>
        </tr>
    </tbody>
</table>
                    
                </div><!--end col 9-->
                
            </div><!-- end row-->   
    </div><!--end md 9-->
    <div class="col-md-3">
        <h1>Sponsored</h1>
    </div><!-- end md 3-->
</div><!--end row-->
 </div><!-- end container-->

