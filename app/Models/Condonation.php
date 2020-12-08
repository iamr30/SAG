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
 * @property int|null $id_assigned
 * @property int|null $user_id
 * @property string|null $comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $expiration_date
 * @property float|null $percentage
 * @property string|null $scholarship_type
 * 
 * @property AssignedSchedule|null $assigned_schedule
 * @property User|null $user
 *
 * @package App\Models
 */
class Condonation extends Model
{
	protected $table = 'condonations';

	protected $casts = [
		'id_assigned' => 'int',
		'user_id' => 'int',
		'percentage' => 'float'
	];

	protected $dates = [
		'expiration_date'
	];

	protected $fillable = [
		'id_assigned',
		'user_id',
		'comments',
		'expiration_date',
		'percentage',
		'scholarship_type'
	];

	public function assigned_schedule()
	{
		return $this->belongsTo(AssignedSchedule::class, 'id_assigned');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
