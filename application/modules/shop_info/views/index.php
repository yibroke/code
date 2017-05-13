<script>
    function doConfirm(id)
    {
        var ok = confirm("Are you sure? You want to delete id " + id);
        if (ok)
        {
            $.ajax({
                type: 'post',
                url: base_url + 'category/delete',
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

<h1>List Category</h1>
    <div id="myerror"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Edit</th>
             
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($query as $row) {
                $edit = base_url() . 'shop_info/insert/' . $row->id;
                ?>
                <tr>
                    <td><?php echo $row->name; ?></a></td>
                    <td><?php echo $row->phone; ?></a></td>
                    <td><?php echo $row->email; ?></a></td>
                    <td><?php echo $row->address; ?></a></td>
                    <td>
                        <a href="<?php echo $edit; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></p></a>
                    </td>
                   
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
<div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>