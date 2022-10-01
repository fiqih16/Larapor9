<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserProfileRequest;
use Illuminate\Support\Facades\File;
use App\Services\User\FileNotFoundException;
use Exception;

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
        $user = new User($data);
        return $this->userRepository->insert($user);
    }

    public function verifyCredentials($email, $password)
    {
        return $this->userRepository->verifyCredentials($email, $password);
    }

    public function saveAvatar(UserProfileRequest $request)
    {
        $user = $this->userRepository->FindById($request->user()->id);

         // cek apakah ada file yang diupload
        if ($request->hasFile('avatar')) {
            // ambil file yang diupload
            $uploaded_avatar = $request->file('avatar');
            // mengambil extension file
            $extension = $uploaded_avatar->getClientOriginalExtension();
            // membuat nama file random berikut extension
            $filename = md5(time()) . '.' . $extension;
            // menyimpan avatar ke folder img/profile
            $request->file('avatar')->move('img/profile', $filename);

            // hapus avatar lama, jika ada
            if ($user->avatar) {
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img/profile'
                . DIRECTORY_SEPARATOR . $user->avatar;
                try {
                    File::delete($filepath);
                } catch (Exception $err) {
                    // File sudah dihapus/tidak ada
                }
            }
            // mengisi field avatar di user dengan filename yang baru dibuat
            $user->avatar = $filename;
            $newAvatar = $this ->userRepository->Insert($user);
            return $newAvatar;
        }
        return $user;
    }
}

?>
