<?php
require_once "vendor/autoload.php";
use Zoli\InterviuCart\Cart;
use Zoli\InterviuCart\CartItem;
use Zoli\InterviuCart\CartItems;
use Zoli\InterviuCart\CartItemSettings;

$cart = new Cart(new CartItemSettings(15, new CartItems()));

$cart->addItem(new CartItem(1, 1, 5));
$cart->addItem(new CartItem(5, 3, 10));
$cart->addItem(new CartItem(1, 2, 5));

echo 'Shipping cost: ' . $cart->getShippingCost() . "\n";
echo 'Cart total: ' . $cart->getTotalValue();