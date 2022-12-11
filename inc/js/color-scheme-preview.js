(function($) {
    var style = $('#slow-atoms-style'),
        api = wp.customize;

    if (!style.length) {
        style = $('head').append('<style type="text/css" id="slow-atoms-style" />')
            .find('#slow-atoms-style');
    }
    // Color Scheme CSS.
    api.bind('preview-ready', function() {
        api.preview.bind('update-color-scheme-css', function(css) {
            style.html(css);
        });
    });
})(jQuery); 