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
    'required' => 'Podaj :attribute.',
    'confirmed' => 'Potwierdzenie :attribute nie pasuje',
    'min' => [
        'string' => 'Długość :attribute musi zawierać co najmniej :min znaków.',
    ],
    'unique' => 'Ten nick jest już zajęty.',
    'alpha' => 'Pole :attribute może tylko zawierać litery.',
    'alpha_num' => 'Pole :attribute może zawierać tylko litery i numery.',
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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'password' => 'hasło',
        'old_password' => 'bieżące hasło',
        'new_password' => 'nowego hasła',
        'name' => 'imię',
        'surname' => 'nazwisko',
        'nickname' => 'nick',

    ],

];
