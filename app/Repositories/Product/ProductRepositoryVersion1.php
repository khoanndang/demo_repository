<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;

class ProductRepositoryVersion1 extends BaseRepository implements ProductInterface {
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function findByStatus(string $status)
    {
        return $this->model->where('status', $status)->get();
    }

    public function testVersion() {
        return 'version_1';
    }
}