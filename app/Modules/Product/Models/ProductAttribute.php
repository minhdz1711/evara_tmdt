<?php

namespace App\Modules\Product\Models;

use App\Modules\Blog\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = "product_attributes";
    protected $guarded = [
        'product_attributes' => 'array',
    ];

    protected $casts = [
        'product_attributes' => 'array',
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
