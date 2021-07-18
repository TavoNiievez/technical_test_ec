<?php

namespace App\Tests\Functional\ExampleContext\Infrastructure\EntryPoint;

use App\Tests\Functional\Shared\Infrastructure\FunctionalCestCase;
use Codeception\Util\HttpCode;
use FunctionalTester;

class DemoEntryPointCest extends FunctionalCestCase
{
    public function _before(FunctionalTester $I)
    {
        parent::setUp($I);
        $this->purge();
        $this->loadFixtures();
    }

    public function _after(FunctionalTester $I)
    {
        $this->purge();
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->sendGet('/demo/test');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'demo' => 'string',
        ]);
        $I->seeResponseContainsJson([
            'demo' => 'testtest',
        ]);
    }
}
