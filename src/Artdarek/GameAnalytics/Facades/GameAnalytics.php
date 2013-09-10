<?php namespace Artdarek\GameAnalytics\Facades;

use Illuminate\Support\Facades\Facade;

class GameAnalytics extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'gameanalytics'; }

}