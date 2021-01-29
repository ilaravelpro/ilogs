<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/17/20, 9:01 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp\Http\Controllers\API\v1\iLog;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

trait Rules
{
    public function rules(Request $request, $action, $parent = null, $unique = null)
    {
        $rules = [];
        switch ($action) {
            case 'store':
            case 'update':
                $rules = [
                    'title' => 'nullable|string'
                ];
                break;
        }
        $unique = $request->has('unique') ? $request->unique : $unique;
        if ($unique) return str_replace(['required'], ['nullable'], _get_value($rules, $unique, 'nullable|string'));
        return $rules;
    }
}
