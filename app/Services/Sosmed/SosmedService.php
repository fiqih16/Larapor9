<?php

namespace App\Services\Sosmed;

use App\Models\Sosmed_link;
use App\Repositories\Sosmed\SosmedRepository;
use App\Http\Requests\Sosmed\StoreSosmedRequest;
use Illuminate\Support\Facades\Auth;

class SosmedService
{
    private $sosmedRepository;

    public function __construct(SosmedRepository $sosmedRepository)
    {
        $this->sosmedRepository = $sosmedRepository;
    }

    public function createSosmed(StoreSosmedRequest $request)
    {
        $sosmed = new Sosmed_link();
        $sosmed->github = $request->github;
        $sosmed->facebook = $request->facebook;
        $sosmed->instagram = $request->instagram;
        $sosmed->web = $request->web;
        $sosmed->user_id = Auth::user()->id;

        // satu user hanya boleh memiliki satu sosmed
        $this->sosmedRepository->deleteByUserId(Auth::user()->id);


        return $this->sosmedRepository->insert($sosmed);
    }
}

?>