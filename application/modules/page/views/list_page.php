<script>
    function doConfirm(id)
    {

        var ok = confirm("Are you sure?");
        if (ok)
        {
            $.ajax({
                type: 'post',
                url: base_url + 'page/delete',
                data: 'id=' + id,
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
                    if (data == 'true')
                    {
                        location.reload();
                    } else {
                       $('#myerror').html('This is not work! - '+ data);
                    }
                }
            });
        }
    }
</script>  

    <h1>List Page</h1>
    <a href="<?php echo base_url(); ?>page/insert"><button class="btn btn-success">Insert</button></a>
    <div id="myerror"></div>
    <table class="table">
        <thead>
            <tr>
                <th>ID </th>
                <th>Page Title </th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($query->result() as $row) {
                $edit = base_url() . 'page/insert/' . $row->id;
                $detail = base_url() . 'page/detail/'. $row->page_url;
                ?>
                <tr>

                    <td><?php echo $row->id; ?></td>
                    <td><a href="<?php echo $detail; ?> "><?php echo $row->page_headline; ?></a></td>

                    <td><a href="<?php echo $edit; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></p</a></td>

                    <!-- not delete special page-->
                    <?php
                    $page_url = $row->page_url;
                    if ($page_url == 'about' || ($page_url == 'not-allow')||($page_url == 'help')||($page_url == 'contact-us')) {
                        //this is speaical page - don't let them delete it.
                        echo '<td>-</td>';
                    } else {
                        ?>
                        <td><a href="#" onclick="doConfirm('<?php echo $row->id; ?>')"><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p></a></td>
                        <?php
                    }
                    ?>
                </tr>

                <?php
            }
            ?>
        </tbody>
    </table>
    <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
