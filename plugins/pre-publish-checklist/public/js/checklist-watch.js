function ppc_check_ready(){
  var ready = true;
  var checks = vars.totalChecklistItems;
  var publishButton = document.getElementById('publishing-action');
  
  for (var i = 1; i <= checks; i++){
    var box_id = 'ppc-check-' + i;
    var this_box = document.getElementById(box_id);
    if ( this_box.checked === false ) {
      var ready = false;
    }
  }
  if ( ready ) {
    publishButton.style.display = 'block';
  } else {
    publishButton.style.display = 'none';
  }
}