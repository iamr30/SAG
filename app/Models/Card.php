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
 * @property int $id_card
 * @property int $id_userCDU
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 *
 * @package App\Models
 */
class Card extends Model
{
	protected $table = 'cards';
	public $timestamps = true;

	protected $casts = [
        'id_userCDU' => 'int',
        'id_card'=>'string'
	];

	protected $dates = [
		'created_at',
		'updated_at'
	];

	protected $fillable = [
		'id_userCDU',
        'id_card',
        'created_at',
        'updated_at'
	];

	public function users_cdu()
	{
		return $this->belongsTo(UsersCdu::class, 'id_userCDU');
	}
}
