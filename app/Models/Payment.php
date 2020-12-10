<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $id
 * @property int $id_userCDU
 * @property string $reference
 * @property string $comments
 * @property Carbon $expiration_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property float $amount
 * @property int $id_assigned
 * 
 * @property AssignedSchedule $assigned_schedule
 * @property UsersCdu $users_cdu
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payments';

	protected $casts = [
		'id_userCDU' => 'int',
		'amount' => 'float',
		'id_assigned' => 'int'
	];

	protected $dates = [
		'expiration_date'
	];

	protected $fillable = [
		'id_userCDU',
		'reference',
		'comments',
		'expiration_date',
		'amount',
		'id_assigned'
	];

	public function assigned_schedule()
	{
		return $this->belongsTo(AssignedSchedule::class, 'id_assigned');
	}

	public function users_cdu()
	{
		return $this->belongsTo(UsersCdu::class, 'id_userCDU');
	}
}
