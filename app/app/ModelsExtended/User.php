<?php

namespace App\ModelsExtended;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use App\ModelsExtended\Traits\HasImageUrlSavingModelTrait;
use App\ModelsExtended\Interfaces\IHasFolderStoragePathModelInterface;



class User extends \App\Models\User implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    IHasFolderStoragePathModelInterface,
    \Illuminate\Contracts\Auth\MustVerifyEmail
{
    use HasFactory, Notifiable;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, HasImageUrlSavingModelTrait;

    protected $appends = [ 'image_url'];

    const DEFAULT_ADMIN = 1;

    /**
     * @param string $email
     * @return Builder|Model|User
     */
    public static function getByEmail(string $email): Model|Builder|User
    {
        return self::query()->where( "email", $email )->firstOrFail();
    }

    /**
     * @param int $id
     * @return Builder|Model|User|null
     */
    public static function getById(int $id): Model|Builder|User|null
    {
        return self::query()->where( "id", $id )->first();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status_id === AccountStatus::APPROVED;
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(AccountStatus::class, 'status_id', 'id');
    }

    public function getFolderStorageRelativePath(): string
    {
        return "users/{$this->id}";
    }

}
