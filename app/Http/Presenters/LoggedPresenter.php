<?php

namespace App\Http\Presenters;

use Micbenner\ModelPresenter\Builder;

class LoggedPresenter extends UserPresenter
{
    /**
     * Define how to turn the model into JSON
     *
     * @param \Micbenner\ModelPresenter\Builder $b
     * @param \App\Domain\Users\User $model
     * @return \Micbenner\ModelPresenter\Builder
     */
    public function build(Builder $b, $model): Builder
    {
        return parent::build($b, $model)
                     ->add('email', $model->getEmail());
    }
}