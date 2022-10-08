<?php


namespace App\Repositories\Portofolio;

use App\Models\Portofolio;

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
}


?>
