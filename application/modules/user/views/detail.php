
<h1>User Detail</h1>
<?php
$row = $query->row();


?>
<table class="table">
    <tbody>

        <tr>
            <th> Name</th>
            <td> <?php echo $row->user_name; ?></td>
        </tr>
        <tr>
            <th> Email</th>
            <td> <?php echo $row->user_email; ?></td>
        </tr>
        <tr>
            <th> Date Join</th>
            <td> <?php echo $row->user_date; ?></td>
        </tr>
        <tr>
            <th> IP</th>
            <td> <?php echo $row->user_ip; ?></td>
        </tr>
        <tr>
            <th> Avatar</th>
            <td> <?php echo $row->user_avatar; ?></td>
        </tr>
        <tr>
            <th> Role</th>
            <td> <?php echo $row->user_role; ?> <a href="<?php echo base_url().'user/change-role/'.$row->user_id; ?>"<button class="btn btn-success">Change role</button></a></td>
        </tr>
        <tr>
            <th> Active</th>
            <td> <?php echo $row->user_active; ?></td>
        </tr>
        <tr>
            <th> About</th>
            <td> <?php echo $row->user_about; ?></td>
        </tr>
        <tr>
            <th> Birth Day</th>
            <td> <?php echo $row->age; ?></td>
        </tr>
        <tr>
            <th> Last Seen</th>
            <td> <?php echo $row->user_last_seen; ?></td>
        </tr>
        <tr>
            <th> Reset password key</th>
            <td> <?php echo $row->reset_password_key; ?></td>
        </tr>
    </tbody>
</table>

