<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductInterface extends RepositoryInterface {
    public function findByStatus(string $status);
    public function testVersion();
}