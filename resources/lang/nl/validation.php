<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'required' => 'Het veld :attribute is verplicht.',
    'email' => 'Het :attribute moet een geldig e-mailadres zijn.',
    'max' => [
        'string' => 'Het :attribute mag niet meer dan :max tekens bevatten.',
    ],
    'min' => [
        'string' => 'Het :attribute moet minstens :min tekens bevatten.',
    ],
    'unique' => 'Het :attribute is al in gebruik.',
    'confirmed' => 'De bevestiging van :attribute komt niet overeen.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        // 'password' => [
        //     'min' => 'Het wachtwoord moet minimaal :min tekens bevatten.',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => 'e-mailadres',
        'password' => 'wachtwoord',
        'password_confirmation' => 'wachtwoordbevestiging',
        'title' => 'titel',
        'body' => 'tekst',
    ],
];
