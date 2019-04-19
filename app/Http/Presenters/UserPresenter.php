<?php

namespace App\Http\Presenters;

use Micbenner\ModelPresenter\Builder;
use Micbenner\ModelPresenter\Presenter;

class UserPresenter extends Presenter
{
    public function dataKey(): string
    {
        return 'user';
    }

    /**
     * Build the model attributes
     *
     * @param Builder $b
     * @param \App\Domain\Users\User $model
     * @return Builder
     */
    public function build(Builder $b, $model): Builder
    {
        return $b->add('id', $model->getId())
                 ->add('name', $model->getName());
    }
}