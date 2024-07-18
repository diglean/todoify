<?php

namespace Domain\Task\Models;

use Domain\Task\Enums\TaskCategory;
use Domain\Task\Enums\TaskStatus;
use Domain\User\Models\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property TaskCategory $category
 * @property string $description
 * @property int $assigned_to
 * @property TaskStatus $status
 * @property int $created_by
 * @property string $overdue_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Users|null $user
 * @method static \Database\Factories\Domain\Task\Models\TasksFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereOverdueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tasks whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tasks extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected $casts = [
		'category' => TaskCategory::class,
		'status' => TaskStatus::class,
	];

	public function user(): HasOne
	{
		return $this->hasOne(Users::class, 'id', 'assigned_to');
	}
}