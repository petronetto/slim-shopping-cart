<?php

namespace Cart\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function hasLowStock(): bool
    {
        if ($this->outOfStock()) {
            return false;
        }

        return (bool) ($this->stock <= 5);
    }

    public function outOfStock(): bool
    {
        return (bool) ($this->stock === 0);
    }

    public function inStock(): bool
    {
        return (bool) ($this->stock >= 1);
    }

    public function hasStock(int $quantity): bool
    {
        return (bool) ($this->stock >= $quantity);
    }
}
