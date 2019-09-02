<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $totalPrice = round((1 - ($this->discount/100)) * $this->price, 2);

        return [
            'name'              => $this->name,
            'price'             => $this->price,
            'discount'          => $this->discount,
            'totalPrice'        => $totalPrice,
            'href'              => [
                'link'       => route('products.show', $this->id)
            ]
        ];
    }
}
