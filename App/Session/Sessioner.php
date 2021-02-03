<?php

namespace Liloy\App\Session;

use Liloy\App\Helpers\Exceptions\SessException;

class Sessioner
{
    private string $sessionPath = __DIR__.'/Sessions';
    public function start(): bool
    {
        if (session_status() !== 0) {
            session_start();
            return true;
        } else {
            throw new SessException('Session: Session disabled.');
        }
    }
    public function setName(string $name): void
    {
        if (session_name($name) === false) {
            throw new SessException('Session: Name setting error.');
        }
    }
    public function setId(string $id): void
    {
        if (session_id($id) === false) {
            throw new SessException('Session: ID setting error.');
        }
    }
    public function getId(): string
    {
        if (session_id() === false) {
            throw new SessException('Session: getting ID error.');
        }
        return session_id();
    }
    public function cookieExists(): bool
    {

        if (array_key_exists('PHPSESSID', $_COOKIE)) {
            return true;
        }
        return false;
    }
    public function sessionExists(): bool
    {
        if (session_status() === 3) {
            return true;
        }
        return false;
    }
    public function destroy(): void
    {
        setcookie('PHPSESSID', null, -1, '/');
        session_gc();
        session_destroy();
    }
    public function setSavePath(string $savePath = null): void
    {
        if ($savePath) {
            $this->sessionPath = $savePath;
            session_save_path($this->sessionPath);
        } else {
            session_save_path($this->sessionPath);
        }
    }
    public function set($key, $value): void
    {
            $_SESSION[$key] = $value;
    }
    public function get($key): string
    {
            return $_SESSION[$key];
    }
    public function contains($key): bool
    {
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }
    public function delete($key): void
    {
        if ($this->contains($key)) {
            unset($_SESSION[$key]);
        } else {
            throw new SessException("Session: $key not found.");
        }
    }
}
