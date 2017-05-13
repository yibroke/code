<div class="container">
    <table class="table">
    <thead>
        <tr>
            
            <th>ID</th>
            <th>Comtent</th>
            <th>Poll </th>
            <th>By </th>
            <th>Date </th>
            
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
  <?php
        foreach ($query as $row) {
            $edit=  base_url().'comment/insert/'.$row->comment_id;
            $detail=base_url().'comment/detail/'.$row->comment_id
            ?>
            <tr>
               
                <td><a href="<?php echo $detail;?> "><?php echo $row->comment_id; ?></a></td>
                <td><?php echo $row->comment_content; ?></a></td>
                <td><a href="<?php echo $detail;?> "><?php echo $row->q_f1; ?></a></td>
                <td><a href="<?php echo $detail;?> "><?php echo $row->user_name; ?></a></td>
                <td><?php echo $this->time_ago->convert_time_ago($row->comment_date); ?></td>

                <td><a href="<?php echo $edit; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></p</a></td>
                <td><a href="#" onclick="doConfirm('<?php echo $row->comment_id; ?>')"><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p></a></td>
            </tr>

            <?php
        }
        ?>
    </tbody>
</table>
    <div class="text-center"><?php echo $this->pagination->create_links(); ?></div>
</div>