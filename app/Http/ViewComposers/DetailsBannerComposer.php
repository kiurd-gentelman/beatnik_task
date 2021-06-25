<?php

namespace App\Http\ViewComposers;


use App\Models\DetailsBanner;
use Illuminate\Contracts\View\View;

class DetailsBannerComposer{

    public function __construct()
    {
    }

    public function compose(View $view){
        $banner = DetailsBanner::count();
        $view->with(['permission' => $banner]);
    }
}
