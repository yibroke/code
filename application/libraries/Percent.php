<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Percent {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('question_model');
    }
  
   function _get_array($question_id) {
         $numItems=$this->CI->question_model->get_num_rows($question_id)-1;
       $votes=$this->CI->question_model->get_vote_time($question_id);
       $i = 0;
     
       $string='';
        foreach ($votes as $vote)
        {
             if($i < $numItems) {
              $string .= $vote->fk_a_id.',';
             }else{
                  $string.=$vote->fk_a_id;
             }
              $i=$i+1;
        }
        
      //  print_r($items);
         $array=  explode(',', $string);
       // print_r($array);
        return $array;
    }
    function array_avg($array, $round = 1) {
            $num = count($array);
            return array_map(
                    function($val) use ($num, $round) {
                return array('count' => $val, 'avg' => round($val / $num * 100, $round));
            }, array_count_values($array));
     }
     function list_answers($question_id)
     {
         $data['answers'] =$this->CI->question_model->get_result($question_id);
         // echo ansser-> percent.
         $array=  $this->_get_array($question_id);
          $avgs = $this->array_avg($array);

         foreach ($data['answers'] as $anser)
         {

                 if (in_array($anser->a_id, $array)) {
                echo "The count of ".$anser->a_f1." is: {$avgs[$anser->a_id]['count']}";
                echo "<br>";
               echo "The Percent of ".$anser->a_f1." is: {$avgs[$anser->a_id]['avg']}";
                }else{
                    echo "The count of ".$anser->a_f1." is: 0";
                     echo "<br>";
                     echo "The Percent of ".$anser->a_f1." is: 0";
                }
         }
         
         
         
       // return $data['answers'];
         
     }

  

}
