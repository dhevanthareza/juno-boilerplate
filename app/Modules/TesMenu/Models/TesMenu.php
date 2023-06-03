<?php

namespace App\Modules\TesMenu\Models;
    
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TesMenu extends Model
{
    use SoftDeletes;
    protected $table = 'tes_menu';
    protected $guarded = [];
}