<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        $data = [
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ];
        return User::create($data);
    }

    public function verifyCredentials($email, $password)
    {
        return $this->userRepository->verifyCredentials($email, $password);
    }

    public function saveAvatar($data)
    {
        $user = $this->userRepository->FindById($data->id);
        $user->avatar = $data->avatar;
        $user->save();
        return $user;
    }
}

?>