<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 14:09
 */

namespace App\Repositories;


use App\Models\AstroturfService;
use App\Repositories\Interfaces\IAstroturfServiceRepository;
use Illuminate\Support\Collection;

class AstroturfServiceRepository implements IAstroturfServiceRepository
{

    public function findById(int $id): ?AstroturfService
    {
        try {
            $service = AstroturfService::findOrFail($id);
            return $service;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $services = AstroturfService::all();
            return $services;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?AstroturfService
    {
        try {
            $service = new AstroturfService();
            $service->title = $data['title'];
            $service->save();
            return $service;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update($id, $data): ?AstroturfService
    {
        // TODO: Implement update() method.
    }
}