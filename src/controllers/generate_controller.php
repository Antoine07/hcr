<?php 
function generate_modules_action(){
    $list_module = [];
    
    $nb = mt_rand(3,6);

    for($i=0;$i<$nb;$i++){
      $list_module[] = new Module;
    }

    add_module_list_bdd_model($list_module);
}