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
    <h1>SẢN PHẨM MỚI</h1>
        <div class="row">
       <?php 
       foreach ($query as $row) {
            ?>
 <div class = "col-xs-6 col-sm-4 col-md-3 thumbnail_cover">
                    <div class = "thumbnail">
                        <img src = " <?php echo base_url().$row->thumb; ?>" alt = "<?php echo $row->name; ?>">
                    </div>
                    <div class = "caption">
                        <p><strong><?php echo word_limiter($row->name, 20, '...');  ?></strong></p>
                        <p class="text-danger"><strong><?php echo $row->price.' '.  lang('curency'); ?></strong></p>
                    </div>
   </div>
        <?php
        }
        ?>
    </div><!-- end row-->
</div>