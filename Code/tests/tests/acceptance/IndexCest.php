<?php
class IndexCest {
    // tests
    public function checkPageContent(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('Visit the index page and determine if Suppliers link exists');
        $I->amOnPage('/index.php/index/index'); 
        $I->see('Suppliers');
        $I->wantTo('Visit the index page and determine if Product Categories link exists');
        $I->see('Product Categories');
        Codeception\Module\logout($I);
    }
}