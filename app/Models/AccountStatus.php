<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountStatus
 * 
 * @property int $id
 * @property int|null $id_userCDU
 * @property float|null $balance
 *
 * @package App\Models
 */
class AccountStatus extends Model
{
	protected $table = 'account_status';
	public $timestamps = false;

	protected $casts = [
		'id_userCDU' => 'int',
		'balance' => 'float'
	];

	protected $fillable = [
		'id_userCDU',
		'balance'
	];
}
