<?php

namespace App\Http\Presenters;

use Micbenner\ModelPresenter\Builder;
use Micbenner\ModelPresenter\Presenter;

class LoggedShowPresenter extends Presenter
{
    public function dataKey(): string
    {
        throw new \Exception('Can only use '. get_class($this) . ' with flat()');
    }

    /**
     * Define how to turn the model into JSON
     *
     * @param \Micbenner\ModelPresenter\Builder $b
     * @param \App\Domain\Users\LoggedShowData $model
     * @return \Micbenner\ModelPresenter\Builder
     */
    public function build(Builder $b, $model): Builder
    {
        return $b->add('user', LoggedPresenter::flat($model->getUser()));
    }
}