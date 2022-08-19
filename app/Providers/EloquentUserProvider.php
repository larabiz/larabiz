<?php

namespace App\Providers;

class EloquentUserProvider extends \Illuminate\Auth\EloquentUserProvider
{
    public function retrieveById($identifier)
    {
        $model = $this->createModel();

        return $this->newModelQuery($model)
            ->with('unreadNotifications')
            ->where($model->getAuthIdentifierName(), $identifier)
            ->first();
    }
}
