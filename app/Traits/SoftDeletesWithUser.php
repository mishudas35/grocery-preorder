<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait SoftDeletesWithUser
{
    public static function bootSoftDeletesWithUser()
    {
        static::deleting(function (Model $model) {
            if ($model->isSoftDeleting()) {
                $model->deleted_by_id = Auth::id(); // Set the deleting user's ID
                $model->save(); // Save the change
            }
        });
    }

    /**
     * Check if the model is being soft deleted.
     *
     * @return bool
     */
    public function isSoftDeleting()
    {
        return $this->forceDeleting === false;
    }
}
