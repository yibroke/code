<br>
<a href="<?php echo base_url(); ?>project/add-project" class="btn btn-success">Add Project</a>
<h1>List tutorials</h1> 
<br>
<table class="table">
    <thead>
        <tr> 
            <th>Name</th>
          
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($query->result() as $row) {
              $edit = base_url() . 'project/add-project/' . $row->id;
            ?>
            <tr>
                <td><a href="<?php echo base_url().'project/project-detail/'.$row->id; ?>"><?php echo $row->name; ?></a></td>
               
                 <td><a href="<?php echo $edit; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></p</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

   
