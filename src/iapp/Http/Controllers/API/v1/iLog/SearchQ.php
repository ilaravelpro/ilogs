<?php



/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/17/20, 9:00 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp\Http\Controllers\API\v1\iLog;


trait SearchQ
{
    public function searchQ($request, $model, $parent)
    {
        $q = $request->q;
        $model->where(function ($query) use ($q) {
            $query->where('i_logs.title', 'LIKE', "%$q%");
        });
    }
}
