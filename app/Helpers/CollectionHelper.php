<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 30.03.2020
 * Time: 17:49
 */

namespace App\Helpers;


use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CollectionHelper
{
    public static function paginate(Collection $results, $perPage)
    {
        $page = Paginator::resolveCurrentPage('page');

        $total = $results->count();
        return self::paginator($results->forPage($page, $perPage), $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }

}