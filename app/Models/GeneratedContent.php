<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'title',
        'meta_title',
        'meta_description',
        'h1',
        'inbound_link',
        'outbound_link',
        'content',
        'content_length',
    ];
}
