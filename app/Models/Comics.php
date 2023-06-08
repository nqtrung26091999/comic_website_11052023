<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comics extends Model
{
    protected $table = 'comics';
    use HasFactory;

    public function addComic($data) {
        DB::insert('INSERT INTO '.$this->table.' (USER_ID , COMIC_NAME, SHORT_DESCRIPTION, TYPE) VALUES(?, ?, ?, ?)', $data);
    }

    public function getAllComics() {
        return DB::select('SELECT * FROM '.$this->table.'');
    }

    public function getComicDetails($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE COMIC_ID = ?', [$id]);
    }

    public function removeComic($id) {
        DB::delete('DELETE FROM '.$this->table.' WHERE COMIC_ID = ?', [$id]);
    }

    public function updateComic($data, $id) {
        $data[] = $id;
        return DB::update('UPDATE '.$this->table.' SET USER_ID = ?, COMIC_NAME = ?, SHORT_DESCRIPTION = ?, TYPE = ?, COVER = ?, UPDATE_AT = ? WHERE COMIC_ID = ?', $data);
    }

    public function updateTotalChapters($data, $id) {
        $data[] = $id;
        return DB::update('UPDATE '.$this->table.' SET TOTAL_CHAPTERS = ?, UPDATE_AT = ? WHERE COMIC_ID = ?', $data);
    }
}
