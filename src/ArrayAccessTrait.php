<?php

declare(strict_types=1);

namespace Yiisoft\Arrays;

use ArrayIterator;

use function count;

/**
 * `ArrayAccessTrait` provides the implementation for {@see \IteratorAggregate}, {@see \ArrayAccess}
 * and {@see \Countable}.
 *
 * Note that `ArrayAccessTrait` requires the class using it contain a property named `data` which should be an array.
 * The data will be exposed by `ArrayAccessTrait` to support accessing the class object like an array.
 *
 * @property array $data
 *
 * @psalm-template TKey as array-key
 * @psalm-template TValue as mixed
 */
trait ArrayAccessTrait
{
    /**
     * Returns an iterator for traversing the data.
     * This method is required by the SPL interface {@see \IteratorAggregate}.
     * It will be implicitly called when you use `foreach` to traverse the collection.
     *
     * @return ArrayIterator An iterator for traversing the cookies in the collection.
     *
     * @infection-ignore-all Infection's PublicVisibility mutator makes this required
     * IteratorAggregate method protected, which violates the interface contract before
     * the test suite can execute.
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Returns the number of data items.
     * This method is required by Countable interface.
     *
     * @return int Number of data elements.
     *
     * @infection-ignore-all Infection's PublicVisibility mutator makes this required
     * Countable method protected, which violates the interface contract before the test
     * suite can execute.
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * This method is required by the interface {@see \ArrayAccess}.
     *
     * @param mixed $offset The offset to check on.
     *
     * @psalm-param TKey $offset
     *
     * @infection-ignore-all Infection's PublicVisibility mutator makes this required
     * ArrayAccess method protected, which violates the interface contract before the test
     * suite can execute.
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * This method is required by the interface {@see \ArrayAccess}.
     *
     * @param mixed $offset The offset to retrieve element.
     *
     * @return mixed The element at the offset, null if no element is found at the offset.
     *
     * @psalm-param TKey $offset
     * @psalm-return TValue
     *
     * @infection-ignore-all Infection's PublicVisibility mutator makes this required
     * ArrayAccess method protected, which violates the interface contract before the test
     * suite can execute.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset] ?? null;
    }

    /**
     * This method is required by the interface {@see \ArrayAccess}.
     *
     * @param mixed $offset The offset to set element.
     * @param mixed $value The element value.
     *
     * @psalm-param TKey|null $offset
     * @psalm-param TValue $value
     *
     * @infection-ignore-all Infection's PublicVisibility mutator makes this required
     * ArrayAccess method protected, which violates the interface contract before the test
     * suite can execute.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * This method is required by the interface {@see \ArrayAccess}.
     *
     * @param mixed $offset The offset to unset element.
     *
     * @psalm-param TKey $offset
     *
     * @infection-ignore-all Infection's PublicVisibility mutator makes this required
     * ArrayAccess method protected, which violates the interface contract before the test
     * suite can execute.
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }
}
