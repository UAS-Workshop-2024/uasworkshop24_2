<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    use HasFactory;
    protected $table = 'slides';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public const ACTIVE = 'active';
	public const INACTIVE = 'inactive';

	public const STATUSES = [
		self::ACTIVE => 'Active',
		self::INACTIVE => 'Inactive',
	];


	public function scopeActive($query)
	{
		return $query->where('status', self::ACTIVE);
    }

	public function prevSlide()
	{
		return self::where('position', '<', $this->position)
			->orderBy('position', 'DESC')
			->first();
    }

	public function nextSlide()
	{
		return self::where('position', '>', $this->position)
			->orderBy('position', 'ASC')
			->first();
	}
}



