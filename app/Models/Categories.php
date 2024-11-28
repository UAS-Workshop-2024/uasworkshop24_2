<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $guarded =[

    ];

    public $timestamps = true;

        /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function childs() {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    public static function childIds($parentId = 0)
	{
		$categories = Categories::select('id','name','parent_id')->where('parent_id', $parentId)->get()->toArray();

		$childIds = [];
		if(!empty($categories)){
			foreach($categories as $category){
				$childIds[] = $category['id'];
				$childIds = array_merge($childIds, Categories::childIds($category['id']));
			}
		}

		return $childIds;
	}

    public function parent(){
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Categories::class);
    }

    public function scopeParentCategories($query)
    {
        return $query->where('parent_id', null);
    }

}
