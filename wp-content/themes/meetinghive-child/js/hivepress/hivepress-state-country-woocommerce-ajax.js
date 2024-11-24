jQuery(document).ready(function($) {
    $('select[name="billing_country"]').change(function() {
        var country = $(this).val();
        console.log(country)
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'get_states',
                country: country,
            },
            success: function(response) {
                var $stateField = $('select[name="billing_state"]');
                $stateField.empty(); // Clear existing options
                if (response) {
                    $.each(response, function(key, value) {
                        $stateField.append($('<option></option>').attr('value', key).text(value));
                    });
                }
            }
        });
    });
});