<?php

namespace App\Repositories\Sosmed;

use App\Models\Sosmed_link;

class SosmedRepository
{
    protected $sosmed;

    public function __construct(Sosmed_link $sosmed)
    {
        $this->sosmed = $sosmed;
    }

    public function insert(Sosmed_link $sosmed)
    {
        $sosmed->save();
        return $sosmed;
    }

    public function update(Sosmed_link $sosmed)
    {
        $sosmed->update();
        return $sosmed;
    }

    public function FindByUserId($id)
    {
        return $this->sosmed->where('user_id', $id)->get();
    }

    public function FindById($id)
    {
        return $this->sosmed->where('id', $id)->first();
    }

    public function deleteByUserId($id)
    {
        return $this->sosmed->where('user_id', $id)->delete();
    }
}

?>
