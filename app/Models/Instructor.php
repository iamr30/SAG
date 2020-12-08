<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Instructor
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $mail
 * @property string|null $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Schedule[] $schedules
 *
 * @package App\Models
 */
class Instructor extends Model
{
	protected $table = 'instructors';

	protected $fillable = [
		'name',
		'mail',
		'phone'
	];

	public function schedules()
	{
		return $this->hasMany(Schedule::class, 'id_instructor');
	}
}
