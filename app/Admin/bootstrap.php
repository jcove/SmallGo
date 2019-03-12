<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use App\Admin\Extensions\CategoryIcon;
use App\Admin\Extensions\WangEditor;
use Encore\Admin\Form;

Encore\Admin\Form::forget(['map']);
Form::extend('categoryIcon', CategoryIcon::class);
Form::extend('itemUrl',\App\Admin\Extensions\ItemUrl::class);
Form::extend('couponUrl',\App\Admin\Extensions\CouponUrl::class);
Form::extend('aether', \App\Admin\Extensions\AetherUpload::class);
Form::extend('editor', WangEditor::class);
