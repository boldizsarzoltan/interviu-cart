<?php
namespace Zoli\InterviuCart;
class CartItems extends \ArrayObject
{
    public function getTotal(): float
    {
        $total = 0;
        /** @var CartItem $cartItem */
        foreach ($this as $cartItem) {
            $total += $cartItem->price * $cartItem->quantity;
        }
        return $total;
    }

    public function addItem(CartItem $newCartItem): void
    {
        if ($this->hasCartItem($newCartItem)) {
            $this->updateCartItemProductQuantity($newCartItem);
            return;
        }
        $this->offsetSet($newCartItem->productId, $newCartItem);
    }

    private function hasCartItem(CartItem $newCartItem): bool
    {
        return $this->offsetExists($newCartItem->productId);
    }

    private function updateCartItemProductQuantity(CartItem $newCartItem): void
    {
        /** @var CartItem $cartItem */
        foreach ($this as $cartItem) {
            if($cartItem->productId === $newCartItem->productId) {
                $cartItem->addQuantity($newCartItem->quantity);
            }
        }
    }
}