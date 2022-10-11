<?php

namespace App\Services\Portofolio;

use App\Http\Requests\Portofolio\StorePortofolioRequest;
use App\Models\Category;
use App\Models\Portofolio;
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
        // $category = Category::findOrFail($request['category_id']);
        // $category = Category::find();
        $portofolio = new Portofolio();
        $portofolio->category_id = $request->category_id;
        $portofolio->name = $request->name;
        $portofolio->description = $request->description;
        $portofolio->link = $request->link;

        $portofolio->slug = Str::slug($request->name . '-' . Auth::user()->id);

        $portofolio->user_id = Auth::user()->id;
        // $result = $category->portofolio()->save($portofolio);
        // return $result;
        return $this->portofolioRepository->insert($portofolio);
    }
}


?>
