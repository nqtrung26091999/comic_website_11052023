<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HoldCategory extends Model
{
    protected $table = 'hold';
    use HasFactory;

    public function getAllHoldCategory() {
        return DB::select('SELECT * FROM '.$this->table.'');
    }

    public function addCategories($id, $categorie_id, $categorie_name) {
        return DB::insert('INSERT INTO '.$this->table.' (COMIC_ID , CATEGORY_ID , HOLD_CATEGORY_NAME) VALUES(?, ?, ?)',[$id, $categorie_id, $categorie_name]);
    }

    public function getByIdComicAndCategory($idComic, $idCategory) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE COMIC_ID = ? AND CATEGORY_ID = ?', [$idComic, $idCategory]);
    }

    public function getByIdCategory($idCategory) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE CATEGORY_ID = ?', [$idCategory]);
    }

    public function getByIdComic($idComic) {
            return DB::select('SELECT * FROM '.$this->table.' WHERE COMIC_ID = ?', [$idComic]);
    }

    public function deleteByIdComicAndCategory($idComic, $idCategory) {
        return DB::delete('DELETE FROM '.$this->table.' WHERE COMIC_ID =? AND CATEGORY_ID = ?', [$idComic, $idCategory]);
    }
    
    public function deleteByIdComic($idComic) {
        return DB::delete('DELETE FROM '.$this->table.' WHERE COMIC_ID = ?', [$idComic]);
    }
}
