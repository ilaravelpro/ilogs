<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/27/21, 1:00 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp;


class LogAgent extends \iLaravel\Core\iApp\Model
{
    public static $s_prefix = 'ILLOGA';
    public static $s_start = 1155;
    public static $s_end = 1733270554752;

    protected $guarded = [];

    protected $hidden = ['device_id', 'platform_id', 'browser_id'];
    public $with = ['device', 'platform', 'browser'];

    protected static function boot()
    {
        parent::boot();
        parent::creating(function (self $event) {
            foreach (['browser', 'device', 'platform'] as $item) {
                if (isset($event->{"_$item"})) {
                    if (!($$item = $event->findByChild($item, (array)$event->{"_$item"}))) {
                        $$item = imodal('LogAgent' . ucfirst($item));
                        $$item = new $$item((array)$event->{"_$item"});
                        $$item->save();
                    }
                    $event->{$item . "_id"} = $$item->id;
                    unset($event->{"_$item"});
                }
            }
        });
    }

    public function findByChild($name, $data)
    {
        $child = imodal('LogAgent' . ucfirst($name));
        foreach ($data as $index => $datum)
            $child = array_keys($data)[0] == $index ? $child::where($index, $datum) : $child->where($index, $datum);
        return $child->first();
    }

    public static function findByAgent($agent)
    {
        return static::where('title', $agent)->first();
    }

    public function device()
    {
        return $this->belongsTo(imodal('LogAgentBrowser'), 'device_id');
    }

    public function platform()
    {
        return $this->belongsTo(imodal('LogAgentPlatform'), 'platform_id');
    }

    public function browser()
    {
        return $this->belongsTo(imodal('LogAgentBrowser'), 'browser_id');
    }
}
