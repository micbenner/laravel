<?php

namespace App\Http\Presenters;

use App\Presentation\Builder;
use App\Presentation\ModelPresenter;

class LoggedShowPresenter extends ModelPresenter
{
    /**
     * Define how to turn the model into JSON
     *
     * @param \App\Presentation\Builder $b
     * @param \App\Domain\Users\LoggedShowData $model
     * @return \App\Presentation\Builder
     */
    public function build(Builder $b, $model): Builder
    {
        return $b->add('user', LoggedPresenter::flat($model->getUser()));
    }
}