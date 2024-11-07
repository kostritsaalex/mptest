jQuery(document).ready(function($) {
    $('#your-form-id').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        let formData = $(this).serialize(); // Serialize form data

        // AJAX request to save user profile
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'save_user_profile',
                formData: formData
            },
            success: function(response) {
                if (response.success) {
                    alert('Profile updated successfully!');
                    location.reload(); // Optionally reload the page to show updated data
                } else {
                    alert(response.data); // Show error message
                }
            },
            error: function() {
                alert('An error occurred while saving the profile.');
            }
        });
    });
});


// jQuery(document).ready(function($) {
//     // Fetch countries on page load
//     $.ajax({
//         type: 'POST',
//         url: ajax_object.ajax_url,
//         data: {
//             action: 'get_countries'
//         },
//         success: function(response) {
//             if (response.success) {
//                 var countrySelect = $('select[name="billing_country"]');
//                 countrySelect.empty();
//                 $.each(response.data, function(key, value) {
//                     countrySelect.append($('<option></option>').attr('value', key).text(value));
//                 });
//             }
//         }
//     });
//
//     // Fetch states when a country is selected
//     $('select[name="billing_country"]').change(function() {
//         var countryCode = $(this).val();
//         $.ajax({
//             type: 'POST',
//             url: ajax_object.ajax_url,
//             data: {
//                 action: 'get_states',
//                 country_code: countryCode
//             },
//             success: function(response) {
//                 if (response.success) {
//                     var stateSelect = $('select[name="billing_state"]');
//                     stateSelect.empty();
//                     $.each(response.data, function(key, value) {
//                         stateSelect.append($('<option></option>').attr('value', key).text(value));
//                     });
//                 }
//             }
//         });
//     });
// });