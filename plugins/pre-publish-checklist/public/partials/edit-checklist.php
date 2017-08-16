<h2>Checklist Editor ( <?php echo $num_ppc_checks ?> checks )</h2>
<form action='<?php echo plugins_url('pre-publish-checklist-update.php', __FILE__); ?>' method='post' id='cl_update'>
  <ul id="checklist-list">
    <?php for ($i = 1; $i <= $num_ppc_checks; $i++): ?>
      <li><input type="text" name="checklist-item[]" value="<?php echo $GLOBALS['checklist_entries'][$i - 1]; ?>"><button class="delete-entry-button" value="delete">Delete</button></li>
    <?php endfor; ?>
  </ul>
  <button id="add-entry-button">Add</button>
  
 <input type='submit' value='submit'>
</form>