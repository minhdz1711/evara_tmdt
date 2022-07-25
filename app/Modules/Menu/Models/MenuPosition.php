<?php

namespace App\Modules\Menu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPosition extends Model
{
    use HasFactory;
    protected $table = "menu_positions";
    protected $guarded = [];
}
