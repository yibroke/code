
 <?php
       
        foreach ($navs as $rown) {
            
            if($rown->count_sub>0)
                    {
                        ?>
     <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><?php echo $rown->name; ?> <span class="caret"></span></a>
    <ul class="dropdown-menu">	
    <?php
      $this->load->module('menu_sub');
      $this->menu_sub->get_sub($rown->id);
    
    ?>
    </ul>
 </li>
    
    <?php
                       
                    }else{
                        ?>
 <li ><a href="<?php echo base_url().$rown->link; ?>"><?php echo $rown->name; ?></a></li>
    
    <?php
                        
                    }
          
        }
        ?>


