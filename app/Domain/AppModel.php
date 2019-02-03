<?php

namespace App\Domain;

use App\Presentation\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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