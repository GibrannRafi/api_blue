<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UUID  {
    protected static function boot (){
        parent ::boot();

        static ::creating (function ($model){
            if (empty ($model->id)){
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing (){
        return false;
    }

    public function getTypeKey (){
        return 'string';
    }   
}
