<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chapters extends Model
{
    protected $table = 'chapters';
    use HasFactory;

    public function addChapter($data) {
        DB::insert('INSERT INTO '.$this->table.' (COMIC_ID, CHAPTER_NAME) VALUES(?, ?)', $data);
    }

    public function getAllChapters() {
        return DB::select('SELECT * FROM '.$this->table.'');
    }

    public function getAllChaptersByIdComic($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE COMIC_ID = ?', [$id]);
    }

    public function getChaptersByIdChapter($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE CHAPTER_ID = ?', [$id]);
    }

    public function removeChapter($idChapter, $idComic) {
        DB::delete('DELETE FROM '.$this->table.' WHERE CHAPTER_ID = ? AND COMIC_ID = ?', [$idChapter, $idComic]);
    }

    public function getChapterDetails($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE CHAPTER_ID = ?', [$id]);
    }

    public function updateChapter($data) {
        return DB::update('UPDATE '.$this->table.' SET  CHAPTER_NAME = ?, UPDATE_AT = ? WHERE CHAPTER_ID = ?', $data);
    }
}
