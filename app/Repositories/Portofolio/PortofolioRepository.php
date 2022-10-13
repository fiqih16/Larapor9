<?php


namespace App\Repositories\Portofolio;

use App\Models\Portofolio;
use App\Models\Portofolio_image;

class PortofolioRepository
{
    protected $portofolio;

    public function __construct(Portofolio $portofolio)
    {
        $this->portofolio = $portofolio;
    }

    public function insert(Portofolio $portofolio)
    {
        $portofolio->save();
        return $portofolio;
    }

    public function insertImage(Portofolio_image $portofolio_image)
    {
        $portofolio_image->save();
        return $portofolio_image;
    }

    public function markAllImageAsNonPrimary(Portofolio_image $portofolio_image)
    {
        $portofolio_image->where('portofolio_id', $portofolio_image->portofolio_id)->update(['is_primary' => 0]);
    }

    public function getPortofolioById($id)
    {
        return $this->portofolio->find($id);
    }

    public function getPortofolioImageCount($id)
    {
        return Portofolio_image::where('portofolio_id', $id)->count();
    }

    public function getPortofolioImageByPortofolioId($id)
    {
        return Portofolio_image::where('portofolio_id', $id)->get();
    }
}


?>