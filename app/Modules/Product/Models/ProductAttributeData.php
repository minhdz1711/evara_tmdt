<?php

namespace App\Modules\Product\Models;

use App\Modules\Blog\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeData extends Model
{
    protected $table = "product_attribute_data";
    protected $guarded = [

    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

}
