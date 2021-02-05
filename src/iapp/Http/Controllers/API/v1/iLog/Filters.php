<?php



/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/4/21, 11:35 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp\Http\Controllers\API\v1\iLog;


trait Filters
{
    public function filters($request, $model, $parent = null, $operators = [])
    {
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
        return [$filters, $current, $operators];
    }
}
