   <?php
       
        foreach ($query1->result() as $row) {
              $edit = base_url() . 'time/add-time/' . $row->id;
            $khong_dau=$this->url_seo->khong_dau($row->cat_name);
            ?>
                       
              <li <?php if($current==$row->id){ echo 'class="active"';} ?>><a href="<?php echo base_url().'category/cate/'.$row->id; ?>"><?php echo $row->cat_name; ?></a></li>
           

            <?php
        }
        