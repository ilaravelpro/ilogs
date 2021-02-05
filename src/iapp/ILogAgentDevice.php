<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/24/21, 9:08 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp;

use Illuminate\Database\Eloquent\Model;

class ILogAgentDevice extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'ILLOGAD';
    public static $s_start = 1155;
    public static $s_end = 1733270554752;

    protected $guarded = [];
}
