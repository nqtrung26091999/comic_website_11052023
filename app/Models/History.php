<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class History extends Model
{
    use HasFactory;

    protected $tableName = 'read_comic';

    public function createHistory($data) {
        DB::table($this->tableName)
        ->insertOrIgnore($data);
    }

    public function getAllHistory() {
        return DB::table($this->tableName)
        ->select()
        ->get();
    }

    public function getHistoryByIdUser($id) {
        return DB::table($this->tableName)
        ->select()
        ->where('USER_ID', $id)
        ->get();
    }

    public function deleteHistory($id) {
        return DB::table('read_comic')
        ->where('CHAPTER_ID', $id)
        ->delete();
    }
}
