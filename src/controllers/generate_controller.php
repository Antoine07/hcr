<?php 
function generate_action(){
    $module_manager = new game\Module_manager(get_pdo());
    $list_module = $module_manager->generate(4);
    $module_manager->store($list_module);
    
}