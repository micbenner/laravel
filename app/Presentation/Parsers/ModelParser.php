<?php

namespace App\Presentation\Parsers;

use App\Presentation\ModelPresenter;
use App\Domain\AppModel;

class ModelParser implements Parser
{
    /**
     * @var \App\Presentation\Presentable|mixed|null
     */
    private $model;

    /**
     * ModelParser constructor.
     * @param mixed|null $model
     */
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * Return the type of the data (Item, Collection, etc)
     *
     * @return string
     */
    public function dataType()
    {
        return ModelPresenter::ITEM;
    }

    /**
     * @param callable $build
     * @return mixed Jsonable data
     */
    public function parse(callable $build)
    {
        if (is_null($this->model)) {
            return null;
        }

        return $build($this->model);
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