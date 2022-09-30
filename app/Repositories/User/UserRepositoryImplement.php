<?php

// namespace App\Repositories\User;

// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// class UserRepositoryImplement implements UserRepository
// {

//     public function getAll()
//     {
//         return User::all();
//     }

//     public function getById($id)
//     {
//         return User::find($id);
//     }

//     public function insert($data)
//     {
//         return User::create($data);
//     }

//     public function FindByEmail($email)
//     {
//         return User::where('email', $email)->first();
//     }

//     public function update($id, $data)
//     {
//         $user = User::find($id);
//         $user->update($data);
//         return $user;
//     }

//     public function delete($id)
//     {
//         $user = User::find($id);
//         $user->delete();
//         return $user;
//     }
// }

?>
