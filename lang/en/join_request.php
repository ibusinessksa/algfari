<?php

return [
    'submitted' => 'Join request submitted successfully. It will be reviewed by the administration.',
    'approved' => 'Join request has been approved.',
    'rejected' => 'Join request has been rejected.',

    'fields' => [
        'full_name' => 'full name',
        'phone_number' => 'mobile number',
        'national_id' => 'national ID',
        'email' => 'email address',
        'pending_family_name' => 'requested family name',
        'region_id' => 'region',
        'password' => 'password',
        'profile_image' => 'profile image',
    ],

    'validation' => [
        'full_name_format' => 'The name may only include Arabic or Latin letters, numbers, spaces, and . \' -',
        'phone_format' => 'Enter a valid Saudi mobile number (10 digits starting with 05, e.g. 0551234567).',
        'phone_pending_request' => 'There is a pending join request for this phone number.',
        'phone_taken' => 'This mobile number is already registered or has a pending join request.',
        'national_id_format' => 'National ID must be 10 digits and start with 1 or 2.',
        'national_id_taken' => 'This national ID is already registered or used in another pending join request.',
        'email_taken' => 'This email is already registered or used in another pending join request.',
        'region_required' => 'Please select your region.',
        'region_invalid' => 'The selected region is invalid.',
        'password_requirements' => 'Password must be at least 8 characters and include both letters and numbers.',
    ],
];
