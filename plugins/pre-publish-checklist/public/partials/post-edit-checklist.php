<form id='pre-publish-checklist-form'>
		<div class='postbox--custom'>
		<div class='postbox__header'>
			<h2>Pre-Publish Checks</h2>
		</div>
		<em>All checks must be ticked before publishing!</em>
		<br>
		<div>
      <?php for ($i = 1; $i <= $num_ppc_checks; $i++): ?>
        <label class='selectit' for='ppc-check-<?php echo $i ?>'>
        <input type='checkbox' id='ppc-check-<?php echo $i ?>' onchange='ppc_check_ready()'></input>
            Hello <?php $i . ": " . $GLOBALS['checklist_entries'][$i - 1]; //$check_titles[$i - 1]; ?>
        </label>
        <br>
      <?php endfor; ?>

    </div>
  </div>
</form>