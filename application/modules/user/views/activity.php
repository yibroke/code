
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-9">
          
            <ul class="nav nav-tabs ">
                <?php $check = $this->uri->segment(2); ?>
                <li <?php if ($check == 'profile') {
                    echo 'class="active"';
                } ?> ><a href="<?php echo base_url().'user/profile/'.$this->uri->segment(3); ?>">Profile</a></li>
                <li  <?php if ($check == 'activity') {
                    echo 'class="active"';
                } ?>><a href="<?php echo base_url().'user/activity/'.$this->uri->segment(3); ?>">Polls</a></li>
            </ul>
            <br>
              <div class="list-question">
                  <h1>폴 리스트</h1>
                <table class="table">
                    <tbody>
                        <?php
                        foreach ($query as $row) {
                            $edit = base_url() . 'topic/edit/' . $row->q_id;
                            $detail = base_url() . 'question/poll/' . $row->q_link;
                            $vote_result = base_url() . 'vote/result/' . $row->q_link;
                            ?>
                            <tr>

                                <td align="center">
    <?php echo $row->count_vote; ?><br>
                                    투표
                                </td>
                                <td align="center">
                                    <?php echo $row->view; ?><br>
                                    전망
                                </td>
                                <td>
                                    <a href="<?php echo $detail; ?> "><h1 class="h1_td"><?php echo $row->q_f1; ?></h1></a>
                                    <span class="glyphicon glyphicon-time"></span>  <?php echo $this->time_ago->convert_time_ago($row->date); ?> . <span class="glyphicon glyphicon-user"></span> <a href="<?php echo base_url().'user/profile/'.$row->user_id; ?>"> <?php echo $row->user_name; ?></a>
                                </td>
                            </tr>

    <?php
}
?>
                    </tbody>
                </table>

                <div class="text-center"><?php echo $this->pagination->create_links(); ?></div>
    </div><!--end list question-->
    </div><!--end md 9-->
    <div class="col-md-3">
        <h1>Sponsored</h1>
    </div><!-- end md 3-->

</div><!--end row-->
 </div><!-- end container-->

