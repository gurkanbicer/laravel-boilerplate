<?php

use Illuminate\Support\Facades\Auth;

function getUserRole()
{
    return (Auth::check()) ? Auth::user()->role : false;
}

function isRoleAdmin()
{
    return (getUserRole() == 'admin') ? true : false;
}

function isRoleSuperUser()
{
    return (getUserRole() == 'superuser') ? true : false;
}

function isRoleUser()
{
    return (getUserRole() == 'user') ? true : false;
}

function isRoleEndUser()
{
    return (getUserRole() == 'enduser') ? true : false;
}

function getRolePermissions($role)
{
    return config()->get('roles')[$role]['contains'];
}

function havePermission($minimumRole)
{
    $role = getUserRole();
    if ($role !== false) {
        if (in_array($minimumRole, getRolePermissions($role))) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getUserRoleName()
{
    $role = getUserRole();
    if ($role !== false) {
        return config()->get('roles')[$role]['alias'];
    } else {
        return null;
    }
}
