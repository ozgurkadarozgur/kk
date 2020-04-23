<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 23.04.2020
 * Time: 21:35
 */

namespace App\Repositories\Interfaces;


use App\Models\AstroturfGallery;
use Illuminate\Support\Collection;

interface IAstroturfGalleryRepository
{
    public function all() : Collection;

    public function create(array $data) : ?AstroturfGallery;
}