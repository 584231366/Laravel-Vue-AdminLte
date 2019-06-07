<?php
namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;

class RoutesFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'RoutesService';
	}
}