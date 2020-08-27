<?php
use Carbon\Carbon;
use App\Model\Admin\Category;

function get_settings() {
    $setting = \App\Model\Admin\Setting::first();
    return $setting;
}

function get_categories(){
    $category = Category::orderBy('category_name','ASC')->get();
    return $category;
}