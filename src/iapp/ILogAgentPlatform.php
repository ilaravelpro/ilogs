<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/19/20, 8:14 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp;

use Illuminate\Database\Eloquent\Model;

class ILogAgentPlatform extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'ILLOGAP';
    public static $s_start = 1155;
    public static $s_end = 1733270554752;

    protected $guarded = [];
}
