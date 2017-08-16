<?php

$num_ppc_checks = count($value);
echo '<h1>Checklist Settings (' . $num_ppc_checks . ' checks)</h1>
	<form method="POST">
		<ul id="checklist-list">';

for ($i = 0; $i < $num_ppc_checks; $i++){
	echo '<li>
			<input type="text" name="checklist-item[]" value="' . $value[$i] . '">
			<button class="delete-entry-button" value="delete">Delete</button>
		</li>';
}
echo '
</ul>
  <button id="add-entry-button">Add</button>';
  
  //echo wp_nonce_field( 'ea_checklist_settings_action' );
  
  echo '
<input type="submit" value="Save" class="button button-primary button-large">
</form>';
 
?>
