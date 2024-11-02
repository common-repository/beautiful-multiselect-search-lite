jQuery(document).ready(function($) {
	var bmspickercolorOptions = {
    // you can declare a default color here,
    // or in the data-default-color attribute on the input
    defaultColor: false,
    // a callback to fire whenever the color changes to a valid color
    change: function(event, ui){},
    // a callback to fire when the input is emptied or an invalid color
    clear: function() {},
    // hide the color picker controls on load
    hide: true,
    // show a group of common colors beneath the square
    // or, supply an array of colors to customize further
    palettes: true
	};
	$('.bms-color-field').wpColorPicker(bmspickercolorOptions);
});
// fin doc ready
//The tricky thing is this particular copy of jQuery is in compatibility mode by default. That means that the typical '$' shortcut for jQuery doesn't work, 
//so it doesn't conflict with any other JavaScript libraries that use the dollar sign also, like MooTools or Prototype.
// Many plugin authors and theme developers are aware of this, and they use 'jQuery' instead of '$' to be safe.

