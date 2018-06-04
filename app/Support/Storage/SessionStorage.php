<?php

namespace Cart\Support\Storage;

use Cart\Support\Storage\Contracts\StorageInterface;
use Countable;

class SessionStorage implements StorageInterface, Countable
{
    protected $bucket;

    public function __construct(string $bucket = 'default')
    {
        if (!isset($_SESSION[$bucket])) {
            $_SESSION[$bucket] = [];
        }

        $this->bucket = $bucket;
    }

    public function get(int $index)
    {
        if (!$this->exists($index)) {
            return null;
        }

        return $_SESSION[$this->bucket][$index];
    }

    public function set(int $index, array $value): void
    {
        $_SESSION[$this->bucket][$index] = $value;
    }

    public function all()
    {
        return $_SESSION[$this->bucket];
    }

    public function exists(int $index): bool
    {
        return (bool) (isset($_SESSION[$this->bucket][$index]));
    }

    public function unset(int $index): void
    {
        if ($this->exists($index)) {
            unset($_SESSION[$this->bucket][$index]);
        }
    }

    public function clear(): void
    {
        unset($_SESSION[$this->bucket]);
    }

    public function count(): int
    {
        return count($this->all());
    }
}
