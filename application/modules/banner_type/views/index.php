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
<a href="<?php echo base_url(); ?>category/insert"><button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Insert</button></a>
    <div id="myerror"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($query as $row) {
                $edit = base_url() . 'category/insert/' . $row->id;
                ?>
                <tr>
                    <td><?php echo $row->cat_name; ?></a></td>
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
