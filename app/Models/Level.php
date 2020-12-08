<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Level
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $id_discipline
 * 
 * @property Discipline|null $discipline
 * @property Collection|Course[] $courses
 *
 * @package App\Models
 */
class Level extends Model
{
	protected $table = 'levels';
	public $timestamps = false;

	protected $casts = [
		'id_discipline' => 'int'
	];

	protected $fillable = [
		'name',
		'id_discipline'
	];

	public function discipline()
	{
		return $this->belongsTo(Discipline::class, 'id_discipline');
	}

	public function courses()
	{
		return $this->hasMany(Course::class, 'id_level');
	}
}
