<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contents extends Model
{
    protected $table = 'contents';
    use HasFactory;

    public function addContent($data) {
        DB::insert('INSERT INTO '.$this->table.' (CHAPTER_ID , FILE_PATH) VALUES(?, ?)', $data);
    }

    public function addContentLightNovel($data) {
        DB::insert('INSERT INTO '.$this->table.' (CHAPTER_ID , CONTENT_LIGHT_NOVEL) VALUES(?, ?)', $data);
    }

    public function getContentByIdChapter($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE CHAPTER_ID = ?', [$id]);
    }

    public function getContentByIdContent($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE CONTENT_ID = ?', [$id]);
    }

    // public function getComicDetails($id) {
    //     return DB::select('SELECT * FROM '.$this->table.' WHERE COMIC_ID = ?', [$id]);
    // }

    public function removeContent($id) {
        DB::delete('DELETE FROM '.$this->table.' WHERE CONTENT_ID = ?', [$id]);
    }

    public function updateGGDriveId($data, $id) {
        return DB::update('UPDATE '.$this->table.' SET GGDRIVE_URL = ? WHERE CONTENT_ID = ?', [$data, $id]);
    }

    // public function updateTotalChapters($data, $id) {
    //     $data[] = $id;
    //     return DB::update('UPDATE '.$this->table.' SET TOTAL_CHAPTERS = ?, UPDATE_AT = ? WHERE COMIC_ID = ?', $data);
    // }
}
