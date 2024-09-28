<?php

namespace Zoli\InterviuCart;

class Cart
{
    private CartItems $cartItems;
    private float $shippingCost;
    private const FREE_SHIPPING_MIN_VALUE = 200;

    public function __construct(CartItemSettings $cartItemSettings)
    {
        $this->cartItems = $cartItemSettings->cartItems;
        $this->shippingCost = $cartItemSettings->shippingCost;
    }

    public function addItem(CartItem $newCartItem): void
    {
        $this->cartItems->addItem($newCartItem);
    }

    public function getTotalValue(): float
    {
        $cartTotal = $this->cartItems->getTotal();
        if (!$this->hasFreeShipping()) {
            $cartTotal += $this->shippingCost;
        }
        return $cartTotal;
    }

    public function getShippingCost(): float
    {
        if ($this->hasFreeShipping()) {
            return 0;
        }
        return $this->shippingCost;
    }

    public function hasFreeShipping(): bool
    {
        return $this->cartItems->getTotal() > self::FREE_SHIPPING_MIN_VALUE;
    }
}
