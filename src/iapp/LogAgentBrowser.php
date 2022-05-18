<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/24/21, 9:08 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp;

class LogAgentBrowser extends \iLaravel\Core\iApp\Model
{
    public static $s_prefix = 'ILLOGAB';
    public static $s_start = 1155;
    public static $s_end = 1733270554752;

    protected $guarded = [];

    public function getTextAttribute()
    {
        return trim($this->family . " ". implode(".", array_filter([$this->major, $this->minor, $this->patch], 'strlen')));
    }
}
