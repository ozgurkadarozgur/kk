<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 23.04.2020
 * Time: 21:36
 */

namespace App\Repositories;


use App\Models\AstroturfGallery;
use App\Repositories\Interfaces\IAstroturfCalendarRepository;
use App\Repositories\Interfaces\IAstroturfGalleryRepository;
use Illuminate\Support\Collection;

class AstroturfGalleryRepository implements IAstroturfGalleryRepository
{

    public function all(): Collection
    {
        try {
            $gallery = AstroturfGallery::all();
            return $gallery;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create(array $data): ?AstroturfGallery
    {
        try {
            $gallery = new AstroturfGallery();
            $gallery->astroturf_id = $data['astroturf_id'];
            $gallery->image_url = $data['image_url'];
            $gallery->save();
            return $gallery;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}