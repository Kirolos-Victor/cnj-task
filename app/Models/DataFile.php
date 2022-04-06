<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFile extends Model
{
    use HasFactory;
    protected $table='data_file';
    protected $fillable=['average_price','total_houses_sold','number_of_crimes_in_2011','average_price_per_year_in_london'];
    public $timestamps=true;
}
