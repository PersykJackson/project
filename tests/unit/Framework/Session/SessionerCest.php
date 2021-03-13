<?php
namespace Framework\Session;

use Liloy\Framework\Helpers\Exceptions\SessException;
use Liloy\Framework\Session\Sessioner;
use UnitTester;

class SessionerCest
{
    private Sessioner $session;

    public function _before(UnitTester $I)
    {
        $this->session = new Sessioner();
    }

    public function _after(UnitTester $I)
    {
        $this->session->destroy();
    }

    // tests
    public function tryToTestSession(UnitTester $I)
    {
        $session = $this->session;
        $session->setName('test');
        $I->assertEquals('test', session_name());
        $session->setId('test123');
        $I->assertEquals('test123', $session->getId());
        $this->session->setSavePath(__DIR__.'/Sessions');
        $I->assertTrue($this->session->start());
        $I->assertTrue($this->session->sessionExists());
        $I->expectThrowable(SessException::class, function () {
            $this->session->start();
        });
        $this->session->set('key', 'test');
        $I->assertTrue($this->session->contains('key'));
        $I->assertEquals('test', $this->session->get('key'));
        $this->session->delete('key');
        $I->assertFalse($this->session->contains('key'));
        $I->expectThrowable(SessException::class, function () {
            $this->session->delete('key');
        });
    }
}
