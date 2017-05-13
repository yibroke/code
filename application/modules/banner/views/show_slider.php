
<!-- Indicators -->
<ol class="carousel-indicators">

    <?php
    $j = 0;

    foreach ($query->result() as $row) {
        ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" <?php if ($j == 0) {
        echo 'class="active"';
    } ?> ></li>

        <?php
        $j++;
    }
    ?> 
</ol>
<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
    <?php
    $i = 1;
    foreach ($query->result() as $row) {
        ?>
        <div class="item <?php if ($i == 1) {
            echo 'active';
        } ?>">
            <a href="<?php echo $row->link; ?>"/><img src="<?php echo base_url() . $row->img; ?>" alt="<?php echo $row->name; ?>" /></a>
        </div>

        <?php
        $i++;
    }
    ?>
</div>          
<!-- Left and right controls -->
