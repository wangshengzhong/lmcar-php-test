<?php

namespace App\Service;

class ProductHandler
{
    private $products = [];

    public function testGetTotalPrice()
    {
        $totalPrice = 0;
        array_walk($this->products,function ($product)use(&$totalPrice){
            $totalPrice += $product['price'] ?: 0;
        });
        return $totalPrice;
    }

    public function testGetProductList()
    {
        $myProductList = array_filter($this->products,function ($product){
            return $product['type'] == 'Dessert';
        });
        usort($myProductList,function ($a,$b){
            return $b['price'] <=> $a['price'];
        });
        return $myProductList;
    }

    public function testGetTimeStampProductList()
    {
        $myProductList = $this->products;
        $myProductList = array_map(function ($v){
            $v['create_at'] = strtotime($v['create_at']);
            return $v;
        },$myProductList);
        return $myProductList;
    }
}