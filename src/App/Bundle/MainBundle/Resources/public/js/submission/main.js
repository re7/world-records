$(document).ready(function() {
    $('[data-ajax-form]').ajaxForm({
        clearForm: true,
        error: function() {

        },
        success: function(data) {
            console.log(data);
        }
    });
});
