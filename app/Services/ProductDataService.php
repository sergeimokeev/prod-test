<?php

namespace App\Services;

class ProductDataService
{
    public function getData($request): array
    {
        return [
            'color' => $request->get('color'),
            'size' => $request->get('size')
        ];
    }

}
