<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function addCategory($data) {
        DB::insert('INSERT INTO '.$this->table.' (CATEGORY_NAME, CATEGORY_DESCRIPTION) VALUES(?, ?)', $data);
    }

    public function getAllCategories() {
        return DB::select('SELECT * FROM '.$this->table.'');
    }

    public function getCategoryByIdComic($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE COMIC_ID = '.$id);
    }

    public function getCategoriesDetails($id) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE CATEGORY_ID = ?', [$id]);
    }

    public function deleteCategory($id) {
        DB::delete('DELETE FROM '.$this->table.' WHERE CATEGORY_ID = ?', [$id]);
    }

    public function getCategoryDetail($id) {
        $select = DB::select('SELECT * FROM '.$this->table.' WHERE CATEGORY_ID = ?', [$id]);
        return $select;
    }

    public function updateCategory($data, $id) {
        $data[] = $id;
        return DB::update('UPDATE '.$this->table.' SET CATEGORY_NAME = ?, CATEGORY_DESCRIPTION = ?, UPDATE_AT = ? WHERE CATEGORY_ID = ?', $data);
    }

}
