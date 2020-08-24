<?php

return [
    'superAdminEmails' => [
        'dmitrii.arnaut@gmail.com'
    ],
    'defaultPermissions' => [
        'home dashboard'
    ],
    'skipAclControllers' => [
        'LoginController',
        'RegisterController',
        'ForgotPasswordController',
        'ResetPasswordController',
        'InviteController',
        'TeamMemberController',
        'ProfileController',
        'HomeController',
        'VerificationController',
    ]
];