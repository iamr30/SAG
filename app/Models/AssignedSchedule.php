<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssignedSchedule
 * 
 * @property int $id
 * @property int|null $id_userCDU
 * @property int|null $id_schedules
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $expiration_date
 * @property float|null $amount
 * 
 * @property UsersCdu|null $users_cdu
 * @property Schedule|null $schedule
 * @property Collection|Condonation[] $condonations
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class AssignedSchedule extends Model
{
	protected $table = 'assigned_schedules';

	protected $casts = [
		'id_userCDU' => 'int',
		'id_schedules' => 'int',
		'amount' => 'float'
	];

	protected $dates = [
		'expiration_date'
	];

	protected $fillable = [
		'id_userCDU',
		'id_schedules',
		'expiration_date',
		'amount'
	];

	public function users_cdu()
	{
		return $this->belongsTo(UsersCdu::class, 'id_userCDU');
	}

	public function schedule()
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
