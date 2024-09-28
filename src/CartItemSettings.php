<?php

namespace Zoli\InterviuCart;

class CartItemSettings
{
    public function __construct(
        public readonly float $shippingCost,
        public readonly CartItems $cartItems
    ) {
    }
}
