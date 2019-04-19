<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Micbenner\ModelPresenter\Presentable;

class AppModel extends Model implements Presentable
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    /*
	|--------------------------------------------------------------------------
	| IS GET AND SET
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

    ///////////////////////////////////////////////

    /**
     * By default we will turn off all model guarding.
     *
     * Tip: request()->only()
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Default to hide everything by default.
     *
     * Tip: Use Model Presenters (or the default Laravel API Resources)
     *
     * @var array
     */
    protected $visible = [];
}