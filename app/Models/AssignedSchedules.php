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
 * @property int $id_userCDU
 * @property int $id_schedules
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 *
 * @package App\Models
 */
class AssignedSchedules extends Model
{
	protected $table = 'assigned_schedules';
	public $timestamps = true;

	protected $casts = [
		'id_userCDU' => 'int',
		'id_schedules' => 'int'
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'expiration_date'
	];

	protected $fillable = [
		'id_userCDU',
		'id_schedules',
		'expiration_date',
		'amount'
	];

	public function usersCdu()
	{
		return $this->belongsTo(UsersCdu::class, 'id_userCDU');
	}

	public function scheduleData()
	{
		return $this->belongsTo(Schedule::class, 'id_schedules');
	}

	public function condonations()
	{
		return $this->hasMany(Condonation::class, 'id_assigned');
	}
	
	public function payments()
	{
		return $this->hasMany(Payment::class, 'id_assigned');
	}

}
