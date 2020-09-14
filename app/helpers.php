<?php

use Illuminate\Support\Facades\Auth;

function getAuthenticatedUserRole()
{
    return (Auth::check()) ? Auth::user()->role : false;
}

function isAuthRoleAdmin()
{
    return (getAuthenticatedUserRole() == 'admin') ? true : false;
}

function isAuthRoleSuperUser()
{
    return (getAuthenticatedUserRole() == 'superuser') ? true : false;
}

function isAuthRoleUser()
{
    return (getAuthenticatedUserRole() == 'user') ? true : false;
}

function isAuthRoleEndUser()
{
    return (getAuthenticatedUserRole() == 'enduser') ? true : false;
}
