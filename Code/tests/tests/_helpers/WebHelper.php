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

class WebHelper extends \Codeception\Module
{
}
