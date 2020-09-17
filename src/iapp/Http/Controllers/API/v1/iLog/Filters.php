<?php


namespace iLaravel\iLogs\iApp\Http\Controllers\API\v1\iLog;


trait Filters
{
    public function filters($request, $model, $parent = null, $operators = [])
    {
        $user = auth()->user();
        $filters = [];
        $current = [];
        $filters = [
            [
                'name' => 'all',
                'title' => _t('all'),
                'type' => 'text',
            ],
            [
                'name' => 'title',
                'title' => _t('title'),
                'type' => 'text'
            ],
        ];
        $this->requestFilter($request, $model, $parent, $filters, $operators);
        if ($request->q) {
            $this->searchQ($request, $model, $parent);
            $current['q'] = $request->q;
        }
        return [$filters, $current, $operators];
    }
}
