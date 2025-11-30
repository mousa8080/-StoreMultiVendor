<?php

namespace App\Repositories\card;

use App\Models\Product;
use Illuminate\Support\Collection;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

interface CardRepositories
{
    public function get(): Collection;
    public function add(Product $product,int $quantity): void;
    public function update(Product $product, int $quantity): void;
    public function delete($id): void;
    public function total(): int;
    public function empty(): void;
}
