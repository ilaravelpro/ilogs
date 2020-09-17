<?php

namespace iLaravel\iLogs\iApp;

use Illuminate\Database\Eloquent\Model;

class ILogAgentBrowser extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'ILLAB';
    public static $s_start = 1155;
    public static $s_end = 1733270554752;

    protected $guarded = [];
}
