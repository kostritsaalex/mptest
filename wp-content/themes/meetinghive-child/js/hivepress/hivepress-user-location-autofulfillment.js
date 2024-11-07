document.addEventListener("DOMContentLoaded", function() {
    const locateButton = document.querySelector('.hp-field--location a[title="Locate Me"]');

    locateButton.addEventListener("click", function(event) {
        event.preventDefault();

        const locationField = document.querySelector('input[name="location"]');
        const locationString = locationField.value.trim();

        // Regular expression to match the location string format
        const locationPattern = /^(.*?),\s(\d+\.?\D?)?,\s(.*?),\s(.*?),\s(\d+)$/;
        const match = locationString.match(locationPattern);

        if (match) {
            // Extract each component based on their capture group in the regex
            const [_, address, , city, country, zip] = match;  // Ignore the house number part
            const state = ""; // State is not in the original string; can be left empty

            // Set values to the respective input fields
            if (!/^\d/.test(city)) { // Ensure city does not start with a number
                document.querySelector('input[name="billing_city"]').value = city;
            } else {
                document.querySelector('input[name="billing_city"]').value = '';
            }
            document.querySelector('input[name="billing_postcode"]').value = zip;
            document.querySelector('input[name="billing_state"]').value = state;

            // Find the country option element
            const countrySelect = document.querySelector('select[name="billing_country"]');
            const countryOption = Array.from(countrySelect.options).find(option => option.text === country);
            if (countryOption) {
                countrySelect.value = countryOption.value;
                // Trigger change event for select2 to update
                countrySelect.dispatchEvent(new Event('change'));
            }

            if (countryOption) {
                countrySelect.value = countryOption.value;
            }
        }
    });
});


