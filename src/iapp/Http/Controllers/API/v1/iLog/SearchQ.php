<?php


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
