
<script>
function doConfirm(id)
{

    var ok= confirm("Are you sure?");
    if(ok)
    {
        $.ajax({
        type:'post',
        url:base_url+'comment/delete',
        data:'id='+id,
        success: function (data) {
            if(data=='true')
            {
                 alert('Delete success!');
                location.reload();  
            }else{
                alert(data);
            }
        }
    });
    }
}
</script>  

    <h1>List Comments</h1>
    <table class="table">
    <thead>
        <tr>  
            <th>Content</th>
            <th>Items </th>
            <th>User </th>
            <th>Date </th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
  <?php
        foreach ($query as $row) {
            $edit=  base_url().'comment/edit/'.$row->comment_id;
            $detail=base_url().'items/detail/'.url_title($row->name).'/'.$row->id
            ?>
            <tr>
                <td><?php echo $row->comment_content; ?></a></td>
                <td><a href="<?php echo $detail;?> "><?php echo $row->name; ?></a></td>
                <td><a href="<?php echo $detail;?> "><?php echo $row->user_name; ?></a></td>
                <td><?php echo $this->time_ago->convert_time_ago($row->comment_date); ?></td>
                <td><a href="#" onclick="doConfirm('<?php echo $row->comment_id; ?>')"><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p></a></td>
            </tr>

     <?php
        }
        ?>
    </tbody>
</table>
    <div class="text-center"><?php echo $this->pagination->create_links(); ?></div>
