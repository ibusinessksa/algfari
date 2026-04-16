<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post-OTP window (minutes)
    |--------------------------------------------------------------------------
    |
    | After successfully verifying the reset OTP (verify-otp purpose reset),
    | the client may submit the new password within this window.
    |
    */
    'session_ttl' => max(5, (int) env('PASSWORD_RESET_SESSION_TTL', 15)),

];
