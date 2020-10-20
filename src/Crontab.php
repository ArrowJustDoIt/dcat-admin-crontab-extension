<?php

namespace Dcat\Admin\Extension\Crontab;

use Dcat\Admin\Extension;

class Crontab extends Extension
{
    const NAME = 'crontab';

    protected $serviceProvider = CrontabServiceProvider::class;

    protected $composer = __DIR__.'/../composer.json';

    protected $migrations = __DIR__.'/../database/migrations';

//    protected $lang = __DIR__.'/../resources/lang';
}