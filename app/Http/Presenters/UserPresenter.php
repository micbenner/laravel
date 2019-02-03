<?php

namespace App\Http\Presenters;

use App\Presentation\Builder;
use App\Presentation\ModelPresenter;

class UserPresenter extends ModelPresenter
{
    /**
     * @var string
     */
    protected $dataKey = 'user';

    /**
     * Define how to turn the model into JSON
     *
     * @param \App\Presentation\Builder $b
     * @param \App\Domain\Auth\Models\User $model
     * @return \App\Presentation\Builder
     */
    public function build(Builder $b, $model): Builder
    {
        return $b->add('id', $model->getKey())
                 ->add('name', $model->getName());
    }
}