$(document).ready(function(){
  // BEGIN ACT MODAL
  $(document).on('click', '#actButton', function(e){
    $('#hiddenID').empty();
    $('#hiddenState').empty();
    $('#currState').empty();	
    $('#nextState').empty();
    e.preventDefault();
    
    var uid = $(this).data('id');
    var active = $(this).data('active');

    if(active == 1){
      curr = "Enabled";
      next = "Disabled";
    } else if (active == 0){
      curr = "Disabled";
      next = "Enabled";
    }

    $('#hiddenID').val(uid);
    $('#hiddenState').val(active);
    $('#currState').append(curr);
    $('#nextState').append(next);
   
  });
  // END ACT MODAL

  // BEGIN DEL MODAL
  $(document).on('click', '#delButton', function(e){
    $('#hiddenID2').empty();
    e.preventDefault();
    
    var uid = $(this).data('id');

    $('#hiddenID2').val(uid);
     
  });
  // END DEL MODAL

});