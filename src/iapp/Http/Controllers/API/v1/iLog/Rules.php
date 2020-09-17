<?php

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
        if ($unique) return str_replace(['required'], ['nullable'], $rules[$unique]);
        return $rules;
    }
}
