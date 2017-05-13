<script>
    function doConfirm(id)
    {
        var ok = confirm("Are you sure? You want to delete id " + id);
        if (ok)
        {
            $.ajax({
                type: 'post',
                url: base_url + 'menu_sub/delete',
                data: {
                    id: id
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
                        alert('Delete success!');
                        location.reload();
                    } else {
                        $('#myerror').html('This is not work! - ' + data);
                    }
                }
            });
        }
    }
</script>  

<h1>List Sub menu</h1>
<a href="<?php echo base_url(); ?>menu_sub/insert"><button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span>Add</button></a>
<a href="<?php echo base_url(); ?>menu_sub/sort"><button class="btn btn-success"><span class="glyphicon glyphicon-sort"></span> Thay đổi thứ tự</button></a>
    <div id="myerror"></div>
    <table class="table">
        <thead>
            <tr>
                <th><?php echo lang('name'); ?></th>
                <th>Link</th>
                <th>Public</th>
                <th><?php echo lang('edit'); ?></th>
                <th><?php echo lang('delete'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($query as $row) {
                 if($row->public=="y")
                      {
                          $public='Yes';
                      }else{
                          $public='No';
                      }
                $edit = base_url() . 'menu_sub/insert/' . $row->id;
                ?>
                <tr>
                    <td><?php echo $row->name; ?></a></td>
                    <td><?php echo $row->link; ?></a></td>
                    <td><?php echo $public; ?></td>
                    <td>
                        <a href="<?php echo $edit; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></p></a>
                    </td>
             
                     <td><a href="#" onclick="doConfirm('<?php echo $row->id; ?>')"><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p></a></td>
                      
                   
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
<div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>