$(document).on("click", "#priceSort", function () {
  var $wrapper = $('.user');

  $wrapper.find('.row').sort(function (a, b) {
    var contentA = parseInt($(a).data('cost'));
    var contentB = parseInt($(b).data('cost'));
    return (contentA - contentB);
  }).appendTo($wrapper);

  return false;
})

$(document).on("click", "#timeSort", function () {
  var $wrapper = $('.user');

  $wrapper.find('.row').sort(function (a, b) {
    var contentA = new Date('1970/01/01 ' + $(a).data('time'));
    var contentB = new Date('1970/01/01 ' + $(b).data('time'));
    return (contentA - contentB);
  }).appendTo($wrapper);

  return false;
})

$(document).on("click", "#seatSort", function () {
  var $wrapper = $('.user');

  $wrapper.find('.row').sort(function (a, b) {
    var contentA = parseInt($(a).data('seats-avail'));
    var contentB = parseInt($(b).data('seats-avail'));
    return (contentA - contentB);
  }).appendTo($wrapper);

  return false;
})
