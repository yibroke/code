
<script>
function doConfirm(id)
{

    var ok= confirm("Are you sure?");
    if(ok)
    {
        $.ajax({
        type:'post',
        url:base_url+'user/delete',
        data:'id='+id,
        success: function (data) {
            if(data=='true')
            {
                location.reload();  
            }else{
                alert('Opps cant delete'+data);
            }
        }
    });
    }
}
</script>  
<h1>List Users</h1>
<table class="table">
    <thead>
        <tr>
            <th>User Name</th>
            <th>User Role</th>
            <th>Email</th>
            <th>Last Seen</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
  <?php
        foreach ($query->result() as $row) {
            $edit=  base_url().'test/insert/'.$row->user_id;
            $detail=base_url().'user/detail/'.$row->user_id;
            $change_role=  base_url().'user/change-role/'.$row->user_id;
              if ($this->time_ago->convert_time_ago($row->user_last_seen) == '방금') {
                        $last_seen= '<p class="text-success"><strong><i class="fa fa-wifi" aria-hidden="true"></i> 온라인으로</strong></p>';
                    } else {
                        $last_seen= $this->time_ago->convert_time_ago($row->user_last_seen);
                    }      
            ?>
            <tr>
                <td><a href="<?php echo $detail;?> "><?php echo $row->user_name; ?></a></td>
                <td><a href="<?php echo $change_role; ?>"><?php echo $row->user_role; ?></a> </td>
                <td><?php echo $row->user_email; ?></td>
                <td><?php echo $last_seen ;?></td>
                <?php
                if($row->user_id==1)
                {
                    echo '<td>-</td>';
                }else{
                    ?>
                 <td><a href="#" onclick="doConfirm('<?php echo $row->user_id; ?>')"><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p></a></td>
                <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
