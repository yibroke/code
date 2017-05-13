<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/include/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/myjs.js" type="text/javascript"></script>
<!-- COLOR PICKER -->
        <link href="<?php echo base_url(); ?>public/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/dist/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- END COLOR PICKER -->
        <script type="text/javascript">
            //set base_url use with ajax
            var base_url = "<?php echo base_url(); ?>";
        </script>


    </head>
    <body>

        
        
        
        <?php
        $this->load->view($module . '/' . $view_file);
        ?>




    </body>
</html>
