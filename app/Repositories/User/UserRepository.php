<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// interface UserRepository
class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function insert(User $user)
    {
        $user->save();
        return $user;
    }

    public function verifyCredentials($email, $password)
    {
        $user = $this->user->where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function FindByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function FindById($id)
    {
        return $this->user->where('id', $id)->first();
    }

    public function Update($id, $data)
    {
        return $this->user->where('id', $id)->update($data);
    }

    // public function getAll();
    // public function getById($id);
    // public function delete($id);
}

?>
