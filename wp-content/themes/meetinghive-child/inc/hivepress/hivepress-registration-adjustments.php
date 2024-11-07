<?php

// Set minimum password length for users to be 6 symbols
add_filter(
    'hivepress/v1/models/user',
    function( $model ) {
        $model['fields']['password']['min_length'] = 6;

        return $model;
    },
    1000
);