Crontab extension for dcat-admin
======

[Crontab](https://github.com/ArrowJustDoIt/dcat-admin-crontab-extension)是一个dcat-admin后台的定时任务扩展插件,你可以通过此插件定时执行shell、sql以及访问指定链接

[laravel-admin版本](https://github.com/ArrowJustDoIt/Crontab)
## 安装

```bash
composer require arrowjustdoit/dcat-admin-crontab-extension
php artisan migrate
```

## 配置

在`config/admin.php`文件的`extensions`配置部分，加上属于这个扩展的配置
```php

    'extensions' => [

        'crontab' => [
        
            // 如果要关掉这个扩展，设置为false
            'enable' => true,
        ]
    ]

```

在服务器中配置crontab

```
crontab -e //回车
* * * * * php /your web dir/artisan autotask:run >>/home/crontab.log 2>&1 //>>后面为日志文件保存地址,可加可不加
```

## 访问

```
https://your domain/admin/crontab #定时任务列表
https://your domain/admin/crontabLog #定时任务日志列表
```


## License

Licensed under [The MIT License (MIT)](LICENSE).