<?php
namespace Framework\Authentication;

use Liloy\Framework\Authentication\Authentication;
use Codeception\Stub;
use Liloy\Framework\Helpers\Exceptions\AuthException;
use Liloy\Framework\Session\Sessioner;
use UnitTester;

class AuthenticationCest
{
    private Authentication $auth;

    private Sessioner $session;

    public function _before(UnitTester $I)
    {
        $this->auth = new Authentication();
        $this->session = new Sessioner();
        $this->session->setSavePath(__DIR__.'/../Session/Sessions');
        $this->session->start();
    }

    public function _after(UnitTester $I)
    {
        $this->session->destroy();
    }

    // tests
    public function tryToTestAuthentication(UnitTester $I)
    {
        $this->session->set('login', 'test');
        $this->session->set('auth', true);
        $I->assertTrue($this->auth->isAuth());
        $I->assertFalse($this->auth->auth('tstss', '12345'));
        $I->assertEquals('test', $this->auth->getLogin());
        $this->session->delete('auth');
        $I->expectThrowable(AuthException::class, function () {
            $this->auth->getLogin();
        });
        $I->expectThrowable(AuthException::class, function () {
            $this->auth->logOut();
        });
    }
}
