<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Product extends Model
{
    use Searchable;
    protected $indexConfigurator = MyIndexConfigurator::class;

    protected $guarded = [];

    protected $mapping = [
        'properties' => [
            'name' => [
                'type' => 'text'
            ],
            'slug' => [
                'type' => 'text'
            ],
            'detail' => [
                'type' => 'text',
            ],
            'description' => [
                'type' => 'text'
            ],
            'created_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ],
        ]
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
