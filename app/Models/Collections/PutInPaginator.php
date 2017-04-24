<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 14:33
 */

namespace App\Models\Collections;

use Illuminate\Pagination\LengthAwarePaginator;

trait PutInPaginator
{
    /**
     * Make collection to paginator
     *
     * @param LengthAwarePaginator $paginator
     * @return LengthAwarePaginator
     */
    public function putInPaginator(LengthAwarePaginator $paginator)
    {
        return new LengthAwarePaginator(
            $paginator->items(),
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
            [
                'path' => $paginator::resolveCurrentPath(),
                'pageName' => $paginator->getPageName(),
            ]
        );
    }
}
