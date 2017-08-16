var checklist = document.querySelector('#checklist-list');
var deleteButtons = Array.from( document.querySelectorAll( '.delete-entry-button' ) );
var editButtons = Array.from( document.querySelectorAll( '.edit-entry-button' ) );
var addButton = document.querySelector( '#add-entry-button' );

// DELETE
checklist.addEventListener( 'click', ( evt ) => {
  evt.preventDefault();

  var target = evt.target;
  if ( target.classList.contains( 'delete-entry-button' ) ) {
    target.parentElement.parentElement.removeChild( target.parentElement );
  }
});

// // EDIT
// editButton.forEach( item => {
//   item.addEventListener( 'click', ( evt ) => {
//     evt.preventDefault();
//     item.parentElement.parentElement.removeChild( item.parentElement );
//   });
// })

// ADD NEW
addButton.addEventListener( 'click', ( evt ) => {
  evt.preventDefault();
  var newItem = document.createElement( 'li' );
  newItem.innerHTML = '<input name="checklist-item[]" type="text"><button class="delete-entry-button" value="delete">Delete</button>';

  checklist.appendChild( newItem );
  newItem.focus();
});