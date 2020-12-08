<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 * 
 * @property int $id
 * @property int|null $id_course
 * @property int|null $id_instructor
 * @property string|null $m
 * @property string|null $t
 * @property string|null $w
 * @property string|null $r
 * @property string|null $f
 * @property string|null $s
 * @property int|null $capacity
 * 
 * @property Course|null $course
 * @property Instructor|null $instructor
 * @property Collection|AssignedSchedule[] $assigned_schedules
 *
 * @package App\Models
 */
class Schedule extends Model
{
	protected $table = 'schedules';
	public $timestamps = false;

	protected $casts = [
		'id_course' => 'int',
		'id_instructor' => 'int',
		'capacity' => 'int'
	];

	protected $fillable = [
		'id_course',
		'id_instructor',
		'm',
		't',
		'w',
		'r',
		'f',
		's',
		'capacity'
	];

	public function course()
	{
		return $this->belongsTo(Course::class, 'id_course');
	}

	public function instructor()
	{
		return $this->belongsTo(Instructor::class, 'id_instructor');
	}

	public function assigned_schedules()
	{
		return $this->hasMany(AssignedSchedule::class, 'id_schedules');
	}
}
