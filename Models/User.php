<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Modules\Admin\Database\Factories\Rbac\UserFactory;
use Modules\Admin\Supports\DefaultValue;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class Preference
 * @package App\Models\Auth
 */
class User extends Authenticatable implements HasMedia, Auditable
{
    use AuditableTrait, HasFactory, Notifiable, InteractsWithMedia, HasRoles, Sortable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'mobile',
        'password',
        'remarks',
        'enabled',
        'email_verified_at',
        'created_by',
        'updated_by',
        'deleted_by'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /************************ Audit Relations ************************/

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /************************ Static Methods ************************/

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }



    /**
     * Register profile Image Media Collection
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->useDisk('avatar')
            ->useFallbackUrl(DefaultValue::USER_PROFILE_IMAGE);
    }

    /**
     * Verify if current user as super admin role
     *
     * @return bool
     */
    public function getIsAdminAttribute(): bool
    {
        return (bool)$this->hasRole('Super Administrator');
    }

    /**
     * Return all Role ID's of a user
     *
     * @return array
     */
    public function getRoleIdsAttribute(): array
    {
        return $this->roles()->pluck('id')->toArray();
    }
    /**
     * Return all Permission ID's of a user
     *
     * @return array
     */
    public function getPermissionIdsAttribute(): array
    {
        return $this->permissions()->pluck('id')->toArray();
    }
}
