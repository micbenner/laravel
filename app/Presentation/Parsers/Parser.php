<?php

namespace App\Presentation\Parsers;

interface Parser
{
    /**
     * Return the type of the data (Item, Collection, etc)
     *
     * @return mixed
     */
    public function dataType();

    /**
     * @param callable $build
     * @return mixed Jsonable data
     */
    public function parse(callable $build);

    /**
     * An array of attributes to append if required
     *
     * @return array
     */
    public function with(): array;
}