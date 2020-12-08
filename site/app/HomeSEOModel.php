<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSEOModel extends Model
{
    public $table='home_seo';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;
}
