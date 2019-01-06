<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Date Limit 最大选择时间区间（天）
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'date_limit' => env('DATE_LIMIT',36000),

    /*
    |--------------------------------------------------------------------------
    | Date Separator 时间区间分隔符
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'separator' => env('DATE_SEPARATOR', ' ~ '),

    /*
    |--------------------------------------------------------------------------
    | Date Format 时间格式
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'format' => env('DATE_FORMAT', 'YYYY-MM-DD HH:mm:ss'),

    /*
    |--------------------------------------------------------------------------
    | Time Increment 分钟选择器增量值
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'time_increment' => env('DATA_TIME_INCREMENT',10),

];