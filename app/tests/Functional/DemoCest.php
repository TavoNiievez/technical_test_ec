<?php

namespace App\Tests\Functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class DemoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->sendGet('/demo');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'demo' => 'boolean',
        ]);
        $I->seeResponseContainsJson([
            'demo' => true,
        ]);
    }
}
