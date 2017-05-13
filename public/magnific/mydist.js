$(document).ready(function() {
var groups = {};
$('.galleryItem').each(function() {
  var id = parseInt($(this).attr('data-group'), 10);
  
  if(!groups[id]) {
    groups[id] = [];
  } 
  
  groups[id].push( this );
});

$.each(groups, function() {
  
  $(this).magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      closeBtnInside: false,
      gallery: { enabled:true }
  });
  
});
});