<?php

namespace App\Services\Portofolio;

use App\Http\Requests\Portofolio\StorePortofolioImgRequest;
use App\Http\Requests\Portofolio\StorePortofolioRequest;
use App\Models\Portofolio;
use App\Models\Portofolio_image;
use App\Repositories\Portofolio\PortofolioRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PortofolioService
{
    private $portofolioRepository;

    public function __construct(PortofolioRepository $portofolioRepository)
    {
        $this->portofolioRepository = $portofolioRepository;
    }

    public function createPortofolio(StorePortofolioRequest $request)
    {
        $portofolio = new Portofolio();
        $portofolio->category_id = $request->category_id;
        $portofolio->name = $request->name;
        $portofolio->description = $request->description;
        $portofolio->link = $request->link;

        // membuat slug dari nama portofolio, dan menambahkan random string di belakangnya
        $portofolio->slug = Str::slug($request->name) . '-' . Str::random(5);

        $portofolio->user_id = Auth::user()->id;

        return $this->portofolioRepository->insert($portofolio);
    }

    public function createPortofolioImage(StorePortofolioImgRequest $request)
    {
        $portofolio_image = new Portofolio_image();
        $portofolio_image->portofolio_id = $request->portofolio_id;

        // cek apakah ada file yang diupload
        if ($request->hasFile('file_name')) {
            // ambil file yang diupload
            $uploaded_file = $request->file('file_name');
            // mengambil extension file
            $extension = $uploaded_file->getClientOriginalExtension();
            // membuat nama file random berikut extension
            $filename = md5(time()) . '.' . $extension;
            // menyimpan file ke folder img/portofolio
            $request->file('file_name')->move('img/portofolio', $filename);
            // mengisi field file_name di portofolio_image dengan filename yang baru dibuat
            $portofolio_image->file_name = $filename;
        } else {
            $portofolio_image->file_name = null;
        }

        // jika portofolio_image berdasarkan id portofolio pertama kali dibuat, maka is_primary = 1
        if ($this->portofolioRepository->getPortofolioImageByPortofolioId($request->portofolio_id)->count() > 0) {
            $portofolio_image->is_primary = 0;
        } else {
            $portofolio_image->is_primary = 1;
        }

        // jika portofolio_image berdasarkan id portofolio tidak ada yang is_primary = 1, maka is_primary = 1 untuk portofolio_image yang baru dibuat
        if ($this->portofolioRepository->getPortofolioImageByPortofolioId($request->portofolio_id)->where('is_primary', 1)->count() == 0) {
            $portofolio_image->is_primary = 1;
        } else {
            $portofolio_image->is_primary = 0;
        }

        return $this->portofolioRepository->insertImage($portofolio_image);
    }
}


?>
