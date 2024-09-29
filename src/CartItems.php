<?php

namespace Zoli\InterviuCart;

use ArrayIterator;

/**
 * @extends \ArrayObject<int,CartItem>
 */
class CartItems extends \ArrayObject
{
    /**
     * @param object|array<mixed> $array
     */
    public function __construct(object|array $array = [])
    {
        parent::__construct([], 0, ArrayIterator::class);
        if (is_array($array) && !empty($array)) {
            foreach ($array as $item) {
                if (!$item instanceof CartItem) {
                    continue;
                }
                $this->addItem($item);
            }
        }
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if (!$value instanceof CartItem) {
            return;
        }
        if ($this->hasCartItem($value)) {
            $this->updateCartItemProductQuantity($value);
            return;
        }
        parent::offsetSet($value->productId, $value);
    }

    public function append(mixed $value): void
    {
        if (!$value instanceof CartItem) {
            return;
        }
        $this->addItem($value);
    }

    /**
     * @param object|array<mixed> $array
     * @return array<CartItem>
     */
    public function exchangeArray(object|array $array): array
    {
        if (!is_array($array) || empty($array)) {
            return $this->getArrayCopy();
        }
        foreach ($array as $item) {
            if (!$item instanceof CartItem) {
                continue;
            }
            $this->addItem($item);
        }
        return $this->getArrayCopy();
    }

    public function getTotal(): float
    {
        $total = 0;
        /** @var CartItem $cartItem */
        foreach ($this as $cartItem) {
            $total += $cartItem->unitPrice * $cartItem->getQuantity();
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

    public function hasCartItem(CartItem $newCartItem): bool
    {
        return $this->offsetExists($newCartItem->productId);
    }

    public function updateCartItemProductQuantity(CartItem $newCartItem): void
    {
        /** @var CartItem $cartItem */
        foreach ($this as $cartItem) {
            if ($cartItem->productId !== $newCartItem->productId) {
                continue;
            }
            $cartItem->addQuantity($newCartItem->getQuantity());
        }
    }
}
