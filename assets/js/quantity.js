jQuery(".button").on("click", function () {
    var oldValue = jQuery("#product-quantity").val(),
        newVal = 1;

    if (jQuery(this).text() == "+") {
        newVal = parseInt(oldValue) + 1;
    } else if (oldValue > 1) {
        newVal = parseInt(oldValue) - 1;
    }

    jQuery("#product-quantity").val(newVal);

});