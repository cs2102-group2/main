function sortCost()
{
  var $wrapper = $('.user');

  $wrapper.find('.row').sort(function (a, b) {
    var contentA = parseInt($(a).data('cost'));
    var contentB = parseInt($(b).data('cost'));
    return (contentA - contentB);
  }).appendTo($wrapper);
}
