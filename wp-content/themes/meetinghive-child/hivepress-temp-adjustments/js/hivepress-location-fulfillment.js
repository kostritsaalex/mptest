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

// document.addEventListener('DOMContentLoaded', function() {
//     // Get the location input field and the "Locate Me" button
//     const locationInput = document.querySelector('input[name="location"]');
//     const locateButton = locationInput.nextElementSibling;
//
//     // Get the other form fields
//     const cityInput = document.querySelector('input[name="billing_city"]');
//     const zipInput = document.querySelector('input[name="billing_postcode"]');
//     const stateInput = document.querySelector('input[name="billing_state"]');
//     const countrySelect = document.querySelector('select[name="billing_country"]');
//
//     // Function to parse the location string and fill out the fields
//     function fillLocationFields() {
//         const locationString = locationInput.value;
//         const parts = locationString.split(', ');
//
//         if (parts.length >= 4) {
//             // Assuming the format is: Street, City, State, Country, Zip
//             const street = parts[0].trim();
//             let city = parts[parts.length - 4].trim();
//
//             // Check if the city starts with a number
//             if (/^\d/.test(city)) {
//                 // If it does, leave the city field empty
//                 city = '';
//             }
//
//             zipInput.value = parts[parts.length - 1].trim();
//             stateInput.value = parts.length === 5 ? parts[parts.length - 3].trim() : '';
//
//             // Find and select the country in the dropdown
//             const country = parts[parts.length - 2].trim();
//             const countryOption = Array.from(countrySelect.options).find(option => option.text === country);
//             if (countryOption) {
//                 countrySelect.value = countryOption.value;
//                 // Trigger change event for select2 to update
//                 countrySelect.dispatchEvent(new Event('change'));
//             }
//
//             cityInput.value = city;
//         }
//     }
//
//     // Add click event listener to the "Locate Me" button
//     locateButton.addEventListener('click', function(e) {
//         e.preventDefault(); // Prevent the default action
//         // Wait a short moment for the location field to be populated
//         setTimeout(fillLocationFields, 500);
//     });
//
//     // Also add an input event listener to the location field
//     locationInput.addEventListener('input', fillLocationFields);
// });



// document.addEventListener('DOMContentLoaded', function() {
//     // Get the location input field and the "Locate Me" button
//     const locationInput = document.querySelector('input[name="location"]');
//     const locateButton = locationInput.nextElementSibling;
//
//     // Get the other form fields
//     const streetInput = document.querySelector('input[name="billing_address_1"]');
//     const cityInput = document.querySelector('input[name="billing_city"]');
//     const zipInput = document.querySelector('input[name="billing_postcode"]');
//     const stateInput = document.querySelector('input[name="billing_state"]');
//     const countrySelect = document.querySelector('select[name="billing_country"]');
//
//     // Function to parse the location string and fill out the fields
//     function fillLocationFields() {
//         const locationString = locationInput.value;
//         const parts = locationString.split(', ');
//
//         if (parts.length >= 4) {
//             // Assuming the format is: Street, City, State, Country, Zip
//             const street = parts[0].trim();
//             let city = parts[parts.length - 4].trim();
//
//             // Check if the city starts with a number
//             if (/^\d/.test(city)) {
//                 // If it does, try to find the next valid city
//                 for (let i = parts.length - 5; i >= 1; i--) {
//                     const potentialCity = parts[i].trim();
//                     if (!/^\d/.test(potentialCity)) {
//                         city = potentialCity;
//                         break;
//                     }
//                 }
//             }
//
//             streetInput.value = street;
//             cityInput.value = city;
//             zipInput.value = parts[parts.length - 1].trim();
//             stateInput.value = parts[parts.length - 3].trim();
//
//             // Find and select the country in the dropdown
//             const country = parts[parts.length - 2].trim();
//             const countryOption = Array.from(countrySelect.options).find(option => option.text === country);
//             if (countryOption) {
//                 countrySelect.value = countryOption.value;
//                 // Trigger change event for select2 to update
//                 countrySelect.dispatchEvent(new Event('change'));
//             }
//         }
//     }
//
//     // Add click event listener to the "Locate Me" button
//     locateButton.addEventListener('click', function(e) {
//         e.preventDefault(); // Prevent the default action
//         // Wait a short moment for the location field to be populated
//         setTimeout(fillLocationFields, 500);
//     });
//
//     // Also add an input event listener to the location field
//     locationInput.addEventListener('input', fillLocationFields);
// });

// document.addEventListener('DOMContentLoaded', function() {
//     // Get the location input field and the "Locate Me" button
//     const locationInput = document.querySelector('input[name="location"]');
//     const locateButton = locationInput.nextElementSibling;
//
//     // Get the other form fields
//     const cityInput = document.querySelector('input[name="billing_city"]');
//     const zipInput = document.querySelector('input[name="billing_postcode"]');
//     const stateInput = document.querySelector('input[name="billing_state"]');
//     const countrySelect = document.querySelector('select[name="billing_country"]');
//
//     // Function to parse the location string and fill out the fields
//     function fillLocationFields() {
//         const locationString = locationInput.value;
//         const parts = locationString.split(', ');
//
//         if (parts.length >= 4) {
//             // Assuming the format is: Street, City, State, Country, Zip
//             cityInput.value = parts[parts.length - 4].trim();
//             zipInput.value = parts[parts.length - 1].trim();
//             stateInput.value = parts[parts.length - 3].trim();
//
//             // Find and select the country in the dropdown
//             const country = parts[parts.length - 2].trim();
//             const countryOption = Array.from(countrySelect.options).find(option => option.text === country);
//             if (countryOption) {
//                 countrySelect.value = countryOption.value;
//                 // Trigger change event for select2 to update
//                 countrySelect.dispatchEvent(new Event('change'));
//             }
//         }
//     }
//
//     // Add click event listener to the "Locate Me" button
//     locateButton.addEventListener('click', function(e) {
//         e.preventDefault(); // Prevent the default action
//         // Wait a short moment for the location field to be populated
//         setTimeout(fillLocationFields, 500);
//     });
//
//     // Also add an input event listener to the location field
//     locationInput.addEventListener('input', fillLocationFields);
// });
