<?php

namespace App\Presentation;

use App\Presentation\Parsers\ArrayParser;
use App\Presentation\Parsers\ModelParser;
use App\Presentation\Parsers\PaginatorParser;
use App\Domain\AppModel;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use JsonSerializable;
use Traversable;

abstract class ModelPresenter implements JsonSerializable
{
    const ITEM = 1;
    const COLLECTION = 2;

    /**
     * @var \App\Presentation\Parsers\Parser
     */
    private $parser;

    /**
     * @var bool
     */
    private $flatten;

    /**
     * An array of attributes to add to every response.
     *
     * Set this using with with() method.
     *
     * @var array
     */
    private $with;

    /**
     * ModelPresenter constructor.
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection $data
     * @param bool $flatten
     */
    public function __construct($data, bool $flatten = false)
    {
        if (is_null($data) || $data instanceof Presentable) {
            $this->parser = new ModelParser($data);
        } elseif ($data instanceof Paginator) {
            $this->parser = new PaginatorParser($data);
        } elseif ($data instanceof Traversable || is_array($data)) {
            $this->parser = new ArrayParser($data);
        } else {
            throw new \RuntimeException("Initial data given to ModelPresenter incompatible");
        }

        $this->flatten = $flatten;
        $this->with    = $this->with();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection $data
     * @return static
     */
    public static function make($data)
    {
        return new static($data);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection $data
     * @return static
     */
    public static function flat($data)
    {
        return new static($data, true);
    }

    /**
     * Define how to turn the model into JSON
     *
     * @param \App\Presentation\Builder $b
     * @param mixed $model
     * @return \App\Presentation\Builder
     */
    abstract public function build(Builder $b, $model): Builder;

    /**
     * @param array $attributes
     * @return $this
     */
    public function merge(array $attributes)
    {
        $this->with = array_merge($this->with, $attributes);

        return $this;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return null|array
     */
    public function toArray(): ?array
    {
        $flatResponse = $this->parseData();

        return $this->flatten ? $flatResponse : array_merge(
            [$this->getDataKey() => $flatResponse],
            $this->parser->with(),
            $this->with
        );
    }

    /**
     * @return array
     */
    protected function parseData()
    {
        $build = function ($model) {
            return $this->build(new Builder, $model)->getAttributes();
        };

        return $this->parser->parse($build);
    }

    /**
     * @return string
     */
    protected function getDataKey()
    {
        if ($this->parser->dataType() === static::ITEM) {
            return $this->dataKey;
        }

        return isset($this->pluralKey) ? $this->pluralKey : Str::plural($this->dataKey);
    }

    /**
     * Define attributes that can always be appended with the response
     *
     * @return array
     */
    protected function with()
    {
        return [];
    }
}