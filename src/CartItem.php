<?php

namespace Zoli\InterviuCart;

class CartItem
{
    public function __construct(
        public readonly int $productId,
        public int $quantity,
        public readonly int $price
    ) {
    }

    public function addQuantity(int $quantity): self
    {
        $this->quantity += $quantity;
        return $this;
    }
}
