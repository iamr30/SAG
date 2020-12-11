<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttendancesRecord
 * 
 * @property int $id
 * @property int $id_userscdu
 * @property Carbon $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property UsersCdu $users_cdu
 *
 * @package App\Models
 */
class AttendancesRecord extends Model
{
	protected $table = 'attendances_record';

	protected $casts = [
		'id_userscdu' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'id_userscdu',
		'date'
	];

	public function users_cdu()
	{
		return $this->belongsTo(UsersCdu::class, 'id_userscdu');
	}
}
