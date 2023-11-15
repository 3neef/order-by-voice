<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait Patterns
{
    protected static function booted()
    {
        static::creating(function ($model) {

            $jsonString = file_get_contents('products.json');

            $data = json_decode($jsonString, true);

             $data['products'][] = $model->name;

            $newJsonString = json_encode($data);

            file_put_contents('products.json', $newJsonString);
        });
    }
}
