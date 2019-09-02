<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $review_count = $this->reviews->count();
        $review_star = $this->reviews->sum('star');
        $rating_sum = $review_star/$review_count;

        $totalPrice = round((1 - ($this->discount/100)) * $this->price, 2);

        $rating = ($review_count > 0) ? round($rating_sum, 2) : 0;
        return [
            'name'              => $this->name,
            'description'       => $this->detail,
            'price'             => $this->price,
            'stock'             => ($this->stock == 0) ? 'Out of stock' : $this->stock,
            'discount'          => $this->discount,
            'totalPrice'        => $totalPrice,
            'rating'            => $rating,
            'href'              => [
                'reviews'       => route('reviews.index', $this->id)
            ]
        ];
    }
}
