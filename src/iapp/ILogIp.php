<?php

namespace iLaravel\iLogs\iApp;

use Illuminate\Database\Eloquent\Model;

class ILogIp extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'ILLIP';
    public static $s_start = 1155;
    public static $s_end = 1733270554752;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        parent::deleting(function (self $event) {
            self::resetRecordsId();
        });
    }
}
