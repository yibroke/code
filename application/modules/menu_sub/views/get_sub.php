<?php
foreach ($querysub as $rowsub) {
   ?>
<li><a href="<?php echo base_url().$rowsub->link; ?>"> <?php echo $rowsub->name; ?> </a></li>
<?php
}

