<?php

namespace Dcat\Admin\Extension\Crontab;

use Dcat\Admin\Admin;
use Dcat\Admin\Extension\Crontab\Http\Commands\AutoTask;
use Illuminate\Support\ServiceProvider;

class CrontabServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $extension = Crontab::make();

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, Crontab::NAME);
        }

        if ($lang = $extension->lang()) {
            $this->loadTranslationsFrom($lang, Crontab::NAME);
        }

        if ($migrations = $extension->migrations()) {
            $this->loadMigrationsFrom($migrations);
        }

        //命令
        if ($this->app->runningInConsole()) {
            $this->commands([
                AutoTask::class,
            ]);
        }

        $this->app->booted(function () use ($extension) {
            $extension->routes(__DIR__.'/../routes/web.php');
        });

        // 添加菜单
        $this->registerMenus();
    }

    protected function registerMenus()
    {
        Admin::menu()->add([
            [
                'id'            => 1,
                'title'         => '定时任务',
                'icon'          => 'fa-gears',
                'uri'           => '',
                'parent_id'     => 0,
            ],
            [
                'id'            => 2,
                'title'         => '任务列表',
                'icon'          => 'fa-tasks',
                'uri'           => 'crontab',
                'parent_id'     => 1,
            ],
            [
                'id'            => 3,
                'title'         => '日志列表',
                'icon'          => 'fa-file-text-o',
                'uri'           => 'crontabLog',
                'parent_id'     => 1,
            ]
        ]);
    }
}