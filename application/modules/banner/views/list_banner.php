<link href="<?php echo base_url(); ?>public/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>public/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script>
function doConfirm(id)
{
    var xhttp;
    var ok= confirm("Are you sure? you want to delete id: "+id);
    if(ok)
    {
        $.ajax({
        type:'post',
        url:base_url+'angels/delete_angel',
        data:'id='+id,
        success: function (data) {
            if(data=='true')
            {
                 location.reload();  
            }
            else
            {
                alert(data)
            }
         
        }
    });
    }
}
  $(function () {
        $('.iframe-btn').fancybox({
            'width': 880,
            'height': 870,
            'type': 'iframe',
             fitToView : false,
              autoSize : false
        });
        $('#download-button').on('click', function () {
            ga('send', 'event', 'button', 'click', 'download-buttons');
        });
        $('.toggle').click(function () {
            var _this = $(this);
            $('#' + _this.data('ref')).toggle(200);
            var i = _this.find('i');
            if (i.hasClass('icon-plus')) {
                i.removeClass('icon-plus');
                i.addClass('icon-minus');
            } else {
                i.removeClass('icon-minus');
                i.addClass('icon-plus');
            }
        });// end fancybox
    
       

    });//end jquery
    function responsive_filemanager_callback(field_id) {
        console.log(field_id);

        var url = jQuery('#' + field_id).val();

        //your code
        // AJAX UPDATE THUMB TO DATABASE.
        //WE NEED THE SOURCE THE ITEM ID.
        console.log('source: ' + url);
        // Ajax update 
        $.ajax({
            type: 'post',
            url: base_url + 'banner/changethumb',
            data: {
                id: field_id,
                thumb_src: url
            },
            beforeSend: function () {
                $('#load').show();
                $('#myerror').hide();
            },
            complete: function ( ) {
                $('#load').hide();
                $('#myerror').show();
            },
            error: function () {
                $('#myerror').html('This is not work!');
            },
            success: function (data) {
                if (data === 'true')
                {
                    location.reload();
                } else {
                    $('#myerror').html('This is not work! - ' + data);
                }

            }
        });// end ajax 
        

    }//end responsive
</script>
<br>
<a href="<?php echo base_url(); ?>banner/add-banner" class="btn btn-success">Add Banner</a>
<h1>List Banner</h1> 
<br>
<table class="table">
    <thead>
        <tr>
            <th>Type</th>
            <th>Name</th>
           
            <th>Img</th>
            <th>Link</th>
          
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
       
        foreach ($query->result() as $row) {
              $edit = base_url() . 'banner/add-banner/' . $row->id;
            ?>
            <tr>
                <td><?php echo $row->type_name; ?></td>
                <td><?php echo $row->name; ?></td>
               
                 <!-- if img url = empty use default img-->
                                 <!-- THUMBNAIL -->
                        <td><a href="<?php echo base_url();?>filemanager/dialog.php?type=1&field_id=<?php echo $row->id; ?>&relative_url=1&fldr=banner" class="btn iframe-btn"><img id="my_image" width="100" src="<?php echo  base_url().$row->img; ?>"></a>
                            <input name="url" id="<?php echo $row->id; ?>" type="hidden" readonly="readonly" value="" required="required"><br><br>
                        </td>
                        <td><?php echo $row->link; ?></td>
                <td><a href="<?php echo $edit; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></p</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

   
