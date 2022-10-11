<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getResults($name)
    {
        return $this->where('name','LIKE',"%{$name}%")
             ->get(); 
    }
}
