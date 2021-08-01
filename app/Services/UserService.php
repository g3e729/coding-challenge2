<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUsers()
    {
        return User::get();
    }

    public function getUser($id)
    {
        return User::find($id);
    }

    public function createUser($request = [])
    {
        $user    = new User;
        $columns = self::columns();

        foreach ($columns as $column) {
            if (isset($request[$column])) {
                $user->$column = $request[$column];
            }
        }

        $user->save();

        return $user;
    }

    public function updateUser($id, $request = [])
    {
        $user = $this->getUser($id);
        $columns      = self::columns();

        foreach ($columns as $column) {
            if (isset($request[$column])) {
                $user->$column = $request[$column];
            }
        }

        $user->save();

        return $user;
    }

    public function delete($id)
    {
        $user = $this->getUser($id);

        return $user->delete();
    }

    public static function columns()
    {
        return (new User)->getFillable();
    }
}