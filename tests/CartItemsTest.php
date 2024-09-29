<?php
namespace Zoli\InterviuCart\Tests;

use PHPUnit\Framework\TestCase;
use Zoli\InterviuCart\CartItem;
use Zoli\InterviuCart\CartItems;

class CartItemsTest extends TestCase
{
    public function testGetTotal()
    {
        $cartItems = new CartItems();
        $this->assertEquals(0, $cartItems->getTotal());
        $cartItems = new CartItems([
            new CartItem(1,2, 3),
            new CartItem(4, 5, 6)
        ]);
        $this->assertEquals(36, $cartItems->getTotal());
    }

    public function testAddItemWithNewItem()
    {
        $cartItems = new CartItems();
        $newCartItem = new CartItem(1, 2, 3);
        $cartItems->addItem($newCartItem);
        $expectedCartItems = new CartItems();
        $expectedCartItems->offsetSet($newCartItem->productId, $newCartItem);
        $this->assertEquals($expectedCartItems, $cartItems);
    }

    public function testAddItemWithExistingItem()
    {
        $cartItems = new CartItems();
        $newCartItem = new CartItem(1, 2, 3);
        $newCartItem2 = new CartItem(1, 3, 3);
        $cartItems->addItem($newCartItem);
        $cartItems->addItem($newCartItem2);
        $expectedCartItems = new CartItems();
        $expectedCartItems->offsetSet($newCartItem->productId, new CartItem(1, 5, 3));
        $this->assertEquals($expectedCartItems, $cartItems);
    }

    public function testHasCartItem()
    {
        $cartItems = new CartItems();
        $newCartItem = new CartItem(1, 2, 3);
        $newCartItem2 = new CartItem(2, 3, 3);
        $cartItems->addItem($newCartItem);
        $this->assertTrue($cartItems->hasCartItem($newCartItem));
        $this->assertFalse($cartItems->hasCartItem($newCartItem2));
    }

    public function testUpdateCartItemQuantity()
    {
        $cartItems = new CartItems();
        $newCartItem = new CartItem(1, 2, 3);
        $newCartItem2 = new CartItem(1, 3, 3);
        $cartItems->updateCartItemProductQuantity($newCartItem2);
        $emptyCartItems = new CartItems();
        $this->assertEquals($emptyCartItems, $cartItems);
        $cartItems->addItem($newCartItem);
        $expectedCartItems = new CartItems();
        $expectedCartItems->addItem(new CartItem(1, 5, 3));
        $cartItems->updateCartItemProductQuantity($newCartItem2);
        $this->assertEquals($expectedCartItems, $cartItems);
    }
}