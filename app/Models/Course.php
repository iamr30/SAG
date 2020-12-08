<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $id_discipline
 * @property int|null $id_level
 * @property Carbon|null $date_start
 * @property Carbon|null $date_end
 * @property int|null $cost
 * @property string|null $reference
 * 
 * @property Discipline|null $discipline
 * @property Level|null $level
 * @property Collection|Schedule[] $schedules
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';
	public $timestamps = false;

	protected $casts = [
		'id_discipline' => 'int',
		'id_level' => 'int',
		'cost' => 'int'
	];

	protected $dates = [
		'date_start',
		'date_end'
	];

	protected $fillable = [
		'name',
		'id_discipline',
		'id_level',
		'date_start',
		'date_end',
		'cost',
		'reference'
	];

	public function discipline()
	{
		return $this->belongsTo(Discipline::class, 'id_discipline');
	}

	public function level()
	{
		return $this->belongsTo(Level::class, 'id_level');
	}

	public function schedules()
	{
		return $this->hasMany(Schedule::class, 'id_course');
	}
}
