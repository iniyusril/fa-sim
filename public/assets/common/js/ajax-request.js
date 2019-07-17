(function () {
    var submitAjaxRequest = function (e) {

        var form = $(this);
        var method = form.find('input[name="_method"]').val() || form.prop('method');

        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function (response) {
                console.log(response);
            }
        });

        e.preventDefault();
    }

    $('form[data-ajax]').on('submit', submitAjaxRequest);
})();