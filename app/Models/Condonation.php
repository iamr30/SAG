<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Condonation
 * 
 * @property int $id
 * @property int $id_userCDU
 * @property string $comments
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property UsersCdu $users_cdu
 *
 * @package App\Models
 */
class Condonation extends Model
{
	protected $table = 'condonations';
	public $incrementing = false;
	public $timestamps = true;

	protected $casts = [
		'id' => 'int'
	];
	protected $dates = [
		'created_at',
		'updated_at'
	];
	protected $fillable = [
		'comments',
		'expiration_date',
		'id_assigned',
		'comments',
		'expiration_date',
		'percentage',
		'scholarship_type'

	];

	public function assigned_schedules()
	{
		return $this->belongsTo(AssignedSchedules::class, 'id_assigned');
	}
}
