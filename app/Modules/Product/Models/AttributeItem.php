<?php

namespace App\Modules\Product\Models;

use App\Modules\Blog\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeItem extends Model
{
    protected $table = "product_attribute_item";
    protected $guarded = [
        'attributes_id' => 'array',
    ];

    protected $casts = [
        'attributes_id' => 'array',
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
