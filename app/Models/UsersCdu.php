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
 * @property string $username
 * @property string $pic
 * @property string $email
 * @property string $code
 * @property string $phone
 * @property bool $active
 * 
 * @property Collection|Condonation[] $condonations
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class UsersCdu extends Model
{
	protected $table = 'users_cdu';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'active' => 'bool'
	];
	
	protected $fillable = [
		'username',
		'email',
		'phone',
		'active',
		'pic',
		'code',
		'amount',
		'user_id'
	];

	
	public function cards()
	{
		return $this->hasMany(Card::class, 'id_userCDU');
	}


	public function assigned_schedules()
	{
		return $this->belongsToMany(Schedule::class,'assigned_schedules','id_userCDU','id_schedules')->withPivot('expiration_date', 'amount','id');
		
	}
	public function user_role()
	{
		return $this->belongsTo(User::class,'user_id');
		
	}
	public function read_assigned_schedules()
	{
		return $this->hasMany(AssignedSchedules::class,'id_userCDU');
	}
}
