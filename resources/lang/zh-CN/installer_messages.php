<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'SmallGo安装程序',
    'next' => '下一步',
    'back' => 'Previous',
    'finish' => '安装',
    'forms' => [
        'errorTitle' => 'The Following errors occurred:',
    ],

    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => 'Welcome',
        'title'   => '欢迎来到SmallGo安装程序',
        'message' => '欢迎来到安装向导.',
        'next'    => 'Check Requirements',
    ],


    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'Step 1 | Server Requirements',
        'title' => '环境要求',
        'next'    => 'Check Permissions',
    ],


    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Step 2 | Permissions',
        'title' => '权限',
        'next' => 'Configure Environment',
    ],


    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'menu' => [
            'templateTitle' => 'Step 3 | Environment Settings',
            'title' => '环境设置',
            'desc' => '请选择配置文件<code>.env</code>的修改方式',
            'wizard-button' => '向导模式',
            'classic-button' => '直接编辑',
        ],
        'wizard' => [
            'templateTitle' => 'Step 3 | Environment Settings | Guided Wizard',
            'title' => '引导 <code>.env</code> 配置',
            'tabs' => [
                'environment' => '环境',
                'database' => '数据库',
                'application' => '应用'
            ],
            'form' => [
                'name_required' => 'An environment name is required.',
                'app_name_label' => '网站名称',
                'app_name_placeholder' => '网站名称',
                'app_environment_label' => '应用环境',
                'app_environment_label_local' => '本地环境',
                'app_environment_label_developement' => '开发环境',
                'app_environment_label_qa' => 'Qa',
                'app_environment_label_production' => '线上环境',
                'app_environment_label_other' => '其他',
                'app_environment_placeholder_other' => 'Enter your environment...',
                'app_debug_label' => '调试模式',
                'app_debug_label_true' => '是',
                'app_debug_label_false' => '否',
                'app_log_level_label' => 'App Log Level',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',
                'app_url_label' => '网址',
                'app_url_placeholder' => '网址，以http开头',
                'db_connection_label' => '数据库类型',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => '主机地址',
                'db_host_placeholder' => 'Database Host',
                'db_port_label' => '端口',
                'db_port_placeholder' => 'Database Port',
                'db_name_label' => '数据库名',
                'db_name_placeholder' => 'Database Name',
                'db_username_label' => '用户名',
                'db_username_placeholder' => 'Database User Name',
                'db_password_label' => '密码',
                'db_password_placeholder' => 'Database Password',

                'app_tabs' => [
                    'more_info' => 'More Info',
                    'broadcasting_title' => 'Broadcasting, Caching, Session, &amp; Queue',
                    'broadcasting_label' => 'Broadcast Driver',
                    'broadcasting_placeholder' => 'Broadcast Driver',
                    'cache_label' => 'Cache Driver',
                    'cache_placeholder' => 'Cache Driver',
                    'session_label' => 'Session Driver',
                    'session_placeholder' => 'Session Driver',
                    'queue_label' => 'Queue Driver',
                    'queue_placeholder' => 'Queue Driver',
                    'redis_label' => 'Redis Driver',
                    'redis_host' => 'Redis Host',
                    'redis_password' => 'Redis Password',
                    'redis_port' => 'Redis Port',

                    'mail_label' => 'Mail',
                    'mail_driver_label' => 'Mail Driver',
                    'mail_driver_placeholder' => 'Mail Driver',
                    'mail_host_label' => 'Mail Host',
                    'mail_host_placeholder' => 'Mail Host',
                    'mail_port_label' => 'Mail Port',
                    'mail_port_placeholder' => 'Mail Port',
                    'mail_username_label' => 'Mail Username',
                    'mail_username_placeholder' => 'Mail Username',
                    'mail_password_label' => 'Mail Password',
                    'mail_password_placeholder' => 'Mail Password',
                    'mail_encryption_label' => 'Mail Encryption',
                    'mail_encryption_placeholder' => 'Mail Encryption',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'Pusher App Id',
                    'pusher_app_id_palceholder' => 'Pusher App Id',
                    'pusher_app_key_label' => 'Pusher App Key',
                    'pusher_app_key_palceholder' => 'Pusher App Key',
                    'pusher_app_secret_label' => 'Pusher App Secret',
                    'pusher_app_secret_palceholder' => 'Pusher App Secret',
                ],
                'buttons' => [
                    'setup_database' => '配置数据库',
                    'setup_application' => '配置应用',
                    'install' => '安装',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => 'Step 3 | Environment Settings | Classic Editor',
            'title' => '直接编辑',
            'save' => '保存 .env',
            'back' => '使用向导',
            'install' => '保存并安装',
        ],
        'success' => ' .env 配置已保存.',
        'errors' => '无法保存文件 .env，请手动创建 .',
        'title' => '环境设置',
        'save' => '保存 .env',
        'success' => '.env 文件保存成功.',
        'errors' => '无法保存 .env 文件, 请手动创建它.',
    ],


    'install' => '安装',

    /**
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'SmallGo已经成功安装',
    ],

    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => '安装完成',
        'templateTitle' => '安装完成',
        'finished' => '程序成功安装完毕.',
        'migration' => 'Migration &amp; Seed Console Output:',
        'console' => 'Application Console Output:',
        'log' => 'Installation Log Entry:',
        'env' => 'Final .env File:',
        'exit' => '点击退出向导',
    ],
    /**
     *
     * Update specific translations
     *
     */
    'updater' => [
        /**
         *
         * Shared translations.
         *
         */
        'title' => ' SmallGo 升级',

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'welcome' => [
            'title'   => '欢迎来到升级向导',
            'message' => '欢迎来到升级向导。',
        ],

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'overview' => [
            'title'   => 'Overview',
            'message' => '1 个待升级.|:number 个待升级.',
            'install_updates' => "安装升级"
        ],

        /**
         *
         * Final page translations.
         *
         */
        'final' => [
            'title' => '完成',
            'finished' => '数据库成功升级.',
            'exit' => '点击退出向导',
        ],

        'log' => [
            'success_message' => 'SmallGo已经成功升级',
        ],
    ],
];
