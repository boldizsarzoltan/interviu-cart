<?php

use PHPUnit\Framework\TestCase;
use Zoli\InterviuCart\CartItem;

class CartItemTest extends TestCase
{
    public function testWorksCorrectly()
    {
        $cartItem = new CartItem(1, 2, 3);
        $this->assertEquals(1, $cartItem->productId);
        $this->assertEquals(2, $cartItem->getQuantity());
        $this->assertEquals(3, $cartItem->unitPrice);
        $cartItem->addQuantity(3);
        $this->assertEquals(5, $cartItem->getQuantity());
    }
}