<?php
add_filter(
    'hivepress/v1/forms/user_update',
    function( $form ) {
        $form['fields']['first_name']['required'] = true;
        $form['fields']['last_name']['required'] = true;

        return $form;
    },
    1000
);