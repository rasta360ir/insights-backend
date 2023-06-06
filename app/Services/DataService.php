<?php

namespace App\Services;

class DataService
{
    public static function getCustomers(): array
    {
        $path = \URL::to('/') . '/storage/images/customers/';

        return [
            [
                'id' => 1,
                'title' => 'سازمان فناوری اطلاعات ایران',
                'imageUrl' => $path. 'ito.png',
            ],
            [
                'id' => 2,
                'title' => 'پارک علم و فناوری',
                'imageUrl' => $path . 'utstpark.png',
            ],
            [
                'id' => 3,
                'title' => 'ایرانسل',
                'imageUrl' => $path . 'irancell.png',
            ],
            [
                'id' => 4,
                'title' => 'بورس اوراق بهادار تهران',
                'imageUrl' => $path . 'tsetmc.png',
            ]
        ];
    }
}
