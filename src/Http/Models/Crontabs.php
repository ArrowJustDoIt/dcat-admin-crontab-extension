<?php

namespace Dcat\Admin\Extension\Crontab\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Crontabs extends Model
{
    //
    protected $table = 'crontab';

    public function crontabLog(){
        return $this->hasMany(CrontabLog::class, 'cid', 'id');
    }
}