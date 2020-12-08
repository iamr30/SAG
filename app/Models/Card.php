<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Card
 * 
 * @property int $id
 * @property string|null $id_card
 * @property int|null $id_userCDU
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property UsersCdu|null $users_cdu
 *
 * @package App\Models
 */
class Card extends Model
{
	protected $table = 'cards';

	protected $casts = [
		'id_userCDU' => 'int'
	];

	protected $fillable = [
		'id_card',
		'id_userCDU'
	];

	public function users_cdu()
	{
		return $this->belongsTo(UsersCdu::class, 'id_userCDU');
	}
}
