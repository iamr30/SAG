<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Concept
 * 
 * @property int $id
 * @property string|null $concept
 * @property string|null $reference
 * @property string|null $agreement
 * @property float|null $cost
 * @property string|null $clabe
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Concept extends Model
{
	protected $table = 'concepts';

	protected $casts = [
		'cost' => 'float'
	];

	protected $fillable = [
		'concept',
		'reference',
		'agreement',
		'cost',
		'clabe'
	];
}
