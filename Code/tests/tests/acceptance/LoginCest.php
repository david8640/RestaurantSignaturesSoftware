<?php
class LoginCept {
	public function cor1(\WebGuy $I) {
        $I->wantTo('COR-1: The system shall display a log in section upon launching.');
        $I->amOnPage('/');
        $I->see('Login');
    }
    
     public function cor2(\WebGuy $I) {
        $I->wantTo('COR-2: Display the main menu on log in.');
        $I->amOnPage('/');
        $I->see('Login');
        //fill in login fields
        $I->fillField('username', 'aassaly');
        $I->fillField('password', 'andrew');
        //attempt to login.
        $I->click('Login');
        $I->see('Welcome back Andrew Assaly');
    }
    
    public function cor3_1(\WebGuy $I) {
        $I->wantTo('COR-3: Display an error with incorrect password.');
        $I->amOnPage('/');
        $I->see('Login');
        //fill in login fields
        $I->fillField('username', 'aassaly');
        $I->fillField('password', 'wrongpassword');
        //attempt to login.
        $I->click('Login');
        $I->see('Incorrect password ☺');
    }
    
    public function cor3_2(\WebGuy $I) {
        $I->wantTo('COR-3: Display an error with incorrect username.');
        $I->amOnPage('/');
        $I->see('Login');
        //fill in login fields
        $I->fillField('username', 'asdfasgweqagas');
        $I->fillField('password', 'anypass');
        //attempt to login.
        $I->click('Login');
        $I->see('Incorrect username ☺');
    }
    
     public function cor4(\WebGuy $I) {
        $I->wantTo('COR-4: Consider a login valid when valid credentials submitted');
        $I->amOnPage('/');
        $I->see('Login');
        //fill in login fields
        $I->fillField('username', 'aassaly');
        $I->fillField('password', 'andrew');
        //attempt to login.
        $I->click('Login');
        $I->see('Welcome Back Andrew Assaly');
    }
    
        
	public function cor27(\WebGuy $I) {
        $I->wantTo('COR-27: Create an account');
        $I->amOnPage('/');
        $I->see('Login');
        //fill in login fields
        $I->fillField('username', 'aassaly');
        $I->fillField('password', 'andrew');
        //attempt to login.
        $I->click('Login');
        $I->see('Welcome Back Andrew Assaly!');
        $I->click('Register!');
        $I->see('Register a new user');
        $I->fillField('username', 'admin');
        $I->fillField('name', 'John Doe');
        $I->fillField('email', 'john@doe.com');
        $I->fillField('password', 'password');
        $I->click('Register');
        $I->see('New user created!');
        $I->see('Login');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'password');
        $I->click('Login');
        $I->see('Welcome Back anonymous!');
    }
    
      public function cor8(\WebGuy $I) {
        $I->wantTo('COR-8: Allow a user to log out from the menu');
        $I->amOnPage('/');
        $I->see('Login');
        //fill in login fields
        $I->fillField('username', 'aassaly');
        $I->fillField('password', 'andrew');
        //attempt to login.
        $I->click('Login');
        $I->see('Welcome Back Andrew Assaly');
        $I->see('Logout');
        $I->click('Logout');
        $I->see("Login");
    }   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
}