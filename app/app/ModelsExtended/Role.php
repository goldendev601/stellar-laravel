<?php

namespace App\ModelsExtended;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Role extends \App\Models\Role
{
    protected $guarded = ['*'];

    public const Super_Admin = 1;
    public const Administrator = 2;

    /**
     * @param int $id
     * @return Role|Builder|Model|object|null
     */
    public static function getById(int $id)
    {
        return self::find($id);
    }
}
