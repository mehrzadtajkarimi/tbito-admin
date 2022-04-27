<?php


namespace App\Http\View\Composers;


use App\Models\City;
use App\Models\Province;
use App\Models\UserLevel;
use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        $view->with('userLevels', UserLevel::all());
        $view->with('provinces', Province::all());
        $view->with('cities', City::all());
    }
}