<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'content_news';
    protected $fillable = [
        "url",
        "judul",
        "deskripsi",
        "scrapping",
    ];
    public function getKontentDeskripsiAttribute()
    {
        return preg_replace('/<figure\b[^>]*>(.*?)<\/figure>/is', '', $this->deskripsi);
    }
}
