$(document).ready(function(){
  // BEGIN ACT MODAL
  $(document).on('click', '#actButton', function(e){
    $('#hiddenID').empty();
    $('#currState').empty();	
    $('#nextState').empty();
    e.preventDefault();
    
    var uid = $(this).data('id');
    var active = $(this).data('active');

    if(active == 1){
      curr = "Active";
      next = "Not Active";
    } else if (active == 0){
      curr = "Not Active";
      next = "Active";
    }

    $('#hiddenID').val(uid);
    $('#currState').append(curr);
    $('#nextState').append(next);
  
    $(document).on('click', '#actConf', function(e){
      var uid2 = "";
      e.preventDefault();
      
      uid2 = $("#hiddenID").val();
      
      $.ajax({
        url: 'updateActive',
        type: 'get',
        data: {id: uid2, state: active},
        dataType: 'json'
      })
      .done(function(response){
        console.log(response);
        location.reload();
      })
      .fail(function(){
        console.log("failed to update id: " + uid2);
      });      
    });    
  });
  // END ACT MODAL

});