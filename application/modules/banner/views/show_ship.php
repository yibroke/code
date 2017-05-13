<?php
 foreach ($query->result() as $row) {
     ?>
       <a href="<?php echo $row->link; ?>"/><img src="<?php echo  base_url().$row->img; ?>" alt="<?php echo $row->name; ?>" /></a>
     <?php
 }
      
               
               