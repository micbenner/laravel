<?php

namespace App\Presentation;

use App\Domain\AppModel;
use Closure;
use Illuminate\Database\Eloquent\Model;

class Builder
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function add(string $key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function whenCall(bool $condition, string $key, callable $value)
    {
        if ($condition) {
            $this->add($key, $value());
        }

        return $this;
    }

    /**
     * @param bool $condition
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function when(bool $condition, string $key, $value)
    {
        if ($condition) {
            $this->add($key, $value);
        }

        return $this;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string|string[] $relation
     * @param string|null $presenter
     * @return $this
     */
    public function whenRelationLoaded(Model $model, $relation, string $presenter = null)
    {
        $key      = is_array($relation) ? key($relation) : $relation;
        $relation = is_array($relation) ? current($relation) : $relation;

        if ($model->relationLoaded($relation)) {
            $value = $model->getRelation($relation);

            $this->add($key, is_null($presenter) ? $value : new $presenter($value, true));
        }

        return $this;
    }
}