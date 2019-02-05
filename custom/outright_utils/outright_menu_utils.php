<?php

function outright_module_menus($module_name){
 	 require_once("include/MVC/View/SugarView.php");
	 $menubean    = new SugarView();
	 $menu        = $menubean->getMenu($module_name);
	 return $menu ? $menu :false;
}

function outright_module_menus_new($module_name='',$add_where=''){
	if($module_name ==''){
		$module_name =$_REQUEST['module'];
		}
		 $sql ="select menu_label as '1',link as '0' ,'Create' as '2' from outri_outright_menu_manager where module_name ='".$module_name."' and deleted =0 and active =1 ";
	
		 $sql = $sql.$add_where;
		
		$module_res =outright_run_sql($sql);
	

        return $module_res;
}

function outright_reset_module_menu($module_name,$record_id){

$curr_menu = outright_module_menus_new($module_name);

		if(!$curr_menu){	
		$old_style_menu =outright_module_menus($module_name);
			foreach($old_style_menu as $key=>$menu){
				$data_array = array();
				$data_array['link'] = $menu[0];
				$data_array['menu_label'] = $menu[1];
				$data_array['action_name'] = $menu[2];
				$data_array['module_name'] = $module_name;
				$data_array['active'] = 1;
				outright_save("outri_outright_menu_manager",$data_array);
			}		 
		}
}



?>
