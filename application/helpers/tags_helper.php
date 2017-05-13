<?php
//make sure this file cant be include and run outside of ci
defined('BASEPATH') OR exit('No direct script access allowed');
     function tags_explode($string) {
         
       $tags=(explode(",",$string));
       echo '<h4>';
       foreach($tags as $tag) {
       echo '<span class="label label-default">'.$tag.'</span>'.' ';
        }
         echo '</h4>';
       
    }