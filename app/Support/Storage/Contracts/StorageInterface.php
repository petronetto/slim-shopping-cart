<?php

namespace Cart\Support\Storage\Contracts;

interface StorageInterface
{
    public function get(int $index);

    public function set(int $index, array $value);

    public function all();

    public function exists(int $index);

    public function unset(int $index);

    public function clear();
}
