<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersCdu
 * 
 * @property int $id
 * @property string|null $username
 * @property string|null $pic
 * @property string|null $code
 * @property string|null $email
 * @property string|null $phone
 * @property bool|null $active
 * @property float|null $amount
 * @property int|null $user_id
 * 
 * @property User|null $user
 * @property Collection|AssignedSchedule[] $assigned_schedules
 * @property Collection|AttendancesRecord[] $attendances_records
 * @property Collection|Card[] $cards
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class UsersCdu extends Model
{
	protected $table = 'users_cdu';
	public $timestamps = false;

	protected $casts = [
		'active' => 'bool',
		'amount' => 'float',
		'user_id' => 'int'
	];

	protected $fillable = [
		'username',
		'pic',
		'code',
		'email',
		'phone',
		'active',
		'amount',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function assigned_schedules()
	{
		return $this->hasMany(AssignedSchedule::class, 'id_userCDU');
	}

	public function attendances_records()
	{
		return $this->hasMany(AttendancesRecord::class, 'id_userscdu');
	}

	public function cards()
	{
		return $this->hasMany(Card::class, 'id_userCDU');
	}

	public function payments()
	{
		return $this->hasMany(Payment::class, 'id_userCDU');
	}
}
