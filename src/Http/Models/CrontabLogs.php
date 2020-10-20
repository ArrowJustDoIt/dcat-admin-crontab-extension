<?php

namespace Dcat\Admin\Extension\Crontab\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CrontabLogs extends Model
{
    //
    protected $table = 'crontab_log';
    protected $fillable = ['type'];

    public function crontab(){
        return $this->belongsTo(Crontab::class, 'cid', 'id');
    }
}