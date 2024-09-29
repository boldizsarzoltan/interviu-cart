<?php

namespace Zoli\InterviuCart;

class CartItem
{
    public function __construct(
        public readonly int $productId,
        private int $quantity,
        public readonly int $unitPrice
    ) {
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function addQuantity(int $quantity): self
    {
        $this->quantity += $quantity;
        return $this;
    }
}
