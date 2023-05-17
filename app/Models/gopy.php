<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gopy extends Model
{
    use HasFactory;
    protected $table = 'gopy';
    protected $fillable = [
		'name',
		'email',
		'sodienthoai',
        'chude',
        'noidung',
	];
}
