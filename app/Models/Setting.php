<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * 
 * @property int $id
 * @property string $key
 * @property string $display_name
 * @property string|null $value
 * @property string|null $details
 * @property string $type
 * @property int $order
 * @property string|null $group
 *
 * @package App\Models
 */
class Setting extends Model
{
	protected $table = 'settings';
	public $timestamps = false;

	protected $casts = [
		'order' => 'int'
	];

	protected $fillable = [
		'key',
		'display_name',
		'value',
		'details',
		'type',
		'order',
		'group'
	];
}
