<?php

namespace iLaravel\iLogs\iApp;

use Illuminate\Database\Eloquent\Model;

class ILog extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;


    public static $s_prefix = 'ILL';
    public static $s_start = 1155;
    public static $s_end = 1733270554752;

    protected $guarded = [];

    protected $hidden = ['agent_id'];
    public $with = ['agent'];

    protected $casts = [
        'request' => 'array',
        'header_request' => 'array',
        'header_response' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        parent::deleting(function (self $event) {
            self::resetRecordsId();
        });
        parent::creating(function (self $event) {
            if (isset($event->_agent)) {
                $event->agent_id = $event->_agent->id;
                unset($event->_agent);
            }
        });
    }

    public function agent() {
        return $this->belongsTo(imodal('ILogAgent'), 'agent_id');
    }

    public function getResponseAttribute($value)
    {
        return $this->getValueByType($value);
    }
}
