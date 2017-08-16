<?php

if (isset($_POST[0] )){

	if (!isset($GLOBALS['num_ppc_checks'] ) ){
  
		global $num_ppc_checks;
		$num_ppc_checks = 3;
    
	}
  
	echo "<ul>";
	for ($i = 0; $i < $num_ppc_checks; $i++){
  
		echo "<li>" . $_POST[$i] . "</li>";
		$GLOBALS['checklist_entries'][$i] = $_POST[$i];
    
	}
  
	echo "</ul><input type='button' onclick='window.history.back()' value='Go Back'>";
}else{

}

?>
