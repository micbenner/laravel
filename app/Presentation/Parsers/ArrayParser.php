<?php

namespace App\Presentation\Parsers;

use App\Presentation\ModelPresenter;

class ArrayParser implements Parser
{
    /**
     * @var \Traversable[]
     */
    private $items;

    /**
     * ArrayParser constructor.
     * @param \Traversable[] $items
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Return the type of the data (Item, Collection, etc)
     *
     * @return mixed
     */
    public function dataType()
    {
        return ModelPresenter::COLLECTION;
    }

    /**
     * @param callable $build
     * @return mixed Jsonable data
     */
    public function parse(callable $build)
    {
        $items = [];

        foreach ($this->items as $key => $item) {
            $items[$key] = $build($item);
        }

        return $items;
    }

    /**
     * An array of attributes to append if required
     *
     * @return array
     */
    public function with(): array
    {
        return [];
    }
}