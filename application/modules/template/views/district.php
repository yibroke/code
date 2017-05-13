<div class="form-group">
    <label for="comment">Quận/ Huyện</label>
    <select name="district" class="form-control" required="required">  
        <option value="">--- Quận/ Huyện ---</option>
        <?php
        foreach ($query as $row) {
            ?>
        <option value="<?php echo $row->dis_id ?>"><?php echo $row->dis_type.' '.$row->dis_name; ?></option>
            <?php }
        ?>
    </select>
</div>  


