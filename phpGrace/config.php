<?php

return array(
    //数据库配置
    'db' => array(
        'databaseType' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'pwd' => 'root',
        'dbname' => 'test',
        'charset' => 'utf8',
        'pre' => ''
    ),
    //支持的缓存类型
    'allowCacheType' => array('file', 'memcache', 'redis'),
    //缓存设置
    'cache' => array(
        'type' => 'file',
        'pre' => 'grace'
    )
);
