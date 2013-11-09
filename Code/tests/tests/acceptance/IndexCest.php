<?php
class IndexCest {
    // tests
    public function checkPageContent(\WebGuy $I) {
            $I->wantTo('Visit the index page and determine if Suppliers link exists');
            $I->amOnPage('/'); 
            $I->see('Suppliers');
            $I->wantTo('Visit the index page and determine if Suppliers link exists');
            $I->see('Product Categories');
    }
}