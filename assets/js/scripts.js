// Avoid `console` errors in browsers that lack a console.
(function() {
  var method
  var noop = function() {}
  var methods = [
    "assert",
    "clear",
    "count",
    "debug",
    "dir",
    "dirxml",
    "error",
    "exception",
    "group",
    "groupCollapsed",
    "groupEnd",
    "info",
    "log",
    "markTimeline",
    "profile",
    "profileEnd",
    "table",
    "time",
    "timeEnd",
    "timeline",
    "timelineEnd",
    "timeStamp",
    "trace",
    "warn"
  ]
  var length = methods.length
  var console = (window.console = window.console || {})

  while (length--) {
    method = methods[length]

    // Only stub undefined methods.
    if (!console[method]) {
      console[method] = noop
    }
  }
})()
if (typeof jQuery === "undefined") {
  console.warn("jQuery hasn't loaded")
} else {
  console.log("jQuery " + jQuery.fn.jquery + " has loaded")
}
// Place any jQuery/helper plugins in here.
jQuery(document).ready(function() {
  jQuery('.tx-imagecycle-pi3').show();
});
jQuery(window).load(function() {
  jQuery('#imagecycle-nivo_c897 img').removeAttr("height").removeAttr("width");
  jQuery('#imagecycle-nivo_c897').nivoSlider({
    effect: 'fade',
    prevText: 'prev',
    nextText: 'next',
    slices: 1,
    boxCols: 8,
    boxRows: 4,
    animSpeed: 500,
    pauseTime: 3000,
    captionOpacity: '0.70',
    directionNav: true,
    directionNavHide: true,
    controlNav: false,
    keyboardNav: true,
    pauseOnHover: true,
    manualAdvance: false
  });
});
