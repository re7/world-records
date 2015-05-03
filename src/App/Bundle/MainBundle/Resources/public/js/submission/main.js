$(document).ready(function() {
    $('form[name=link]').ajaxForm({
        clearForm: true,
        error: function() {

        },
        success: function(data) {
            $('#submission_playerName').val(data.playerName);
            $('#submission_playerLink').val(data.playerLink);
            $('#submission_game').val(data.game);
            $('#submission_category').val(data.category);
            $('#submission_link').val(data.link);
            $('#submission_platform').val(data.platform);
            $('#submission_time').val(data.time);
            $('#submission_date_year').val(data.dateYear);
            $('#submission_date_month').val(data.dateMonth);
            $('#submission_date_day').val(data.dateDay);
        }
    });
});
