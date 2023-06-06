<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 * @method static orderBy(string $string, string $string1)
 */

class BaseModel extends Model
{
    use HasFactory;
}
