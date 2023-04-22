console.log(my_custom_plugin_settings);
if (my_custom_plugin_settings.feature_1_enabled) {
    // Call the functions on document ready
    document.addEventListener('DOMContentLoaded', function() {
        disableSelection(document);
        disableCopying();
    });
} else {
    // Call the functions on document ready
    document.addEventListener('DOMContentLoaded', function() {
        enableSelection(document);
    });
}

if (my_custom_plugin_settings.feature_2_enabled) {
    // Call the functions on document ready
    document.addEventListener('DOMContentLoaded', function() {
        disableSelection(document);
        disableCopying();
    });
} else {
    // Call the functions on document ready
    document.addEventListener('DOMContentLoaded', function() {
        enableSelection(document);
        enableCopying();
    });
}

// Remove text selection disabling
function enableSelection(element) {
    if (typeof element.onselectstart != 'undefined') {
        element.onselectstart = null;
    } else if (typeof element.style.MozUserSelect != 'undefined') {
        element.style.MozUserSelect = 'text';
    } else {
        element.onmousedown = null;
    }
}

// Remove text copying disabling
function enableCopying() {
    document.removeEventListener('copy', function(event) {
        event.preventDefault();
        return false;
    });
}

// Disable text selection
function disableSelection(element) {
    if (typeof element.onselectstart != 'undefined') {
        element.onselectstart = function() { return false; };
    } else if (typeof element.style.MozUserSelect != 'undefined') {
        element.style.MozUserSelect = 'none';
    } else {
        element.onmousedown = function() { return false; };
    }
}

// Disable text copying
function disableCopying() {
    document.addEventListener('copy', function(event) {
        event.preventDefault();
        return false;
    });
}
