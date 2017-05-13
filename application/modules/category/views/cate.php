<script>
    $(document).ready(function () {
        //start load more
        $('#testloadmore').click(function () {
console.log('load click');

            $.ajax({
                url: base_url + 'test/more',
                type: 'post',
                beforeSend: function () {
                    $('#load').show();
                },
                complete: function ( ) {
                    $('#load').hide();
                },
                error: function () {
                    alert('Some error');
                    
                },
             
                success: function (data) {
                    var jsonData = JSON.parse(data);
                    $('#moredata').append(jsonData.view);
                   
                }
            });
           
        });//end click
    });//end ready
</script>
<div class="container">
    <h1><?php echo $cate_name; ?></h1>
        <div class="row">
       <?php 
       foreach ($query as $row) {
              ?>
           
             <div class="list-group-item">
                 <div class="row">
                     <div class="col-md-12">
                      
                <a href="<?php echo base_url().'read/'.url_title($row->topic_name, '-', TRUE).'/'.$row->id; ?>"><h3> <?php echo $row->topic_name; ?></h3></a>
                 <span class="glyphicon glyphicon-time"></span> <?php echo $this->time_ago->convert_time_ago($row->topic_date); ?> 
                
                 <div class="text-left"><p><?php echo tags_explode($row->topic_tag); ?></p></div>
				 </div><!-- end col md 9-->
                </div>
                </div><!-- end row-->
                
                <?php
        }
        ?>
    </div><!-- end row-->
    
     <div class="text-center">
                <?php  echo $this->pagination->create_links(); ?>
            </div>
</div>