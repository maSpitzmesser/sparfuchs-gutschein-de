jQuery(".tabs li").click(function () {
  var num = jQuery(".tabs li").index(this);
  jQuery(".sk").addClass('hidden');
  jQuery(".sk").eq(num).removeClass('hidden');
  jQuery(".tabs li").removeClass('active');
  jQuery(".tabs li").eq(num).addClass('active');
});

jQuery("option").click(function () {
  var num = jQuery("option").index(this);
  jQuery(".select-content").addClass('hidden');
  jQuery(".select-content").eq(num).removeClass('hidden');
  jQuery("option").removeClass('active');
  jQuery("option").eq(num).addClass('active');
});