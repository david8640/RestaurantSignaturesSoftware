<?php
namespace Codeception\Module;

// here you can define custom functions for WebGuy 
function login(\WebGuy $I) {
    $I->amOnPage('/');
    $I->fillField('username', 'aassaly');
    $I->fillField('password', 'andrew');
    $I->click('Login');
}

function logout(\WebGuy $I) {
    $I->click('Logout');
}

function getUrl() {
    // Local
    //return "/seg4910-project/Code/RestaurantManagementSoftware/index.php/";
    // Server
    return "/current/Code/RestaurantManagementSoftware/index.php/";
}

class WebHelper extends \Codeception\Module
{
}
