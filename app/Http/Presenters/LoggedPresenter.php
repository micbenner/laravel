<?php

namespace App\Http\Presenters;

use App\Presentation\Builder;
use Carbon\Carbon;

class LoggedPresenter extends UserPresenter
{
    /**
     * Define how to turn the model into JSON
     *
     * @param \App\Presentation\Builder $b
     * @param \App\Domain\Auth\Models\User $model
     * @return \App\Presentation\Builder
     */
    public function build(Builder $b, $model): Builder
    {
        return parent::build($b, $model)
                     ->add('email', $model->getEmail());
    }
}