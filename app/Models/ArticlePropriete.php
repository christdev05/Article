<?php

namespace App\Models;

use App\Models\ProprieteArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticlePropriete extends Model
{
    use HasFactory;

    public $table = "article_propriete";
    public $fillable = [
        "article_id", "propriete_article_id", "valeur"
    ];

    public function propriete(){
        return $this->hasOne(ProprieteArticle::class,'id', 'propriete_article_id'); 
    }
}
