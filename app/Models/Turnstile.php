<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Turnstile
 * 
 * @property int $id
 * @property string|null $device
 * @property string|null $port
 * @property string|null $controller
 *
 * @package App\Models
 */
class Turnstile extends Model
{
	protected $table = 'turnstiles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'device',
		'port',
		'controller'
	];
}
