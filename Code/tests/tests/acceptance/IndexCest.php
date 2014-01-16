<?php
class IndexCest {
    // tests
    public function checkPageContent(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('Visit the index page and determine if all appropriate links exists');
        $I->amOnPage('/index.php/index/index'); 
        $I->see('Suppliers');
        $I->see('Product Categories');
        $I->see('Restaurants');
        $I->see('User Access');
        $I->see('Welcome');
        $I->see('Logout');
        Codeception\Module\logout($I);
    }
}