<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function addUser($data) {
        DB::insert('INSERT INTO '.$this->table.' (username, password, fullname, birthday, email, account_type, gender) VALUES(?, ?, ?, ?, ?, ?, ?)', $data);
    }

    public function registerUser($data) {
        DB::insert('INSERT INTO '.$this->table.' (username, password, email) VALUES(?, ?, ?)', $data);
    }

    public function getAll() {
       $select = DB::select('SELECT * FROM '.$this->table.'');
       return $select;
    }

    public function getDetail($id) {
        $select = DB::select('SELECT * FROM '.$this->table.' WHERE USER_ID = ?', [$id]);
        return $select;
    }

    public function getDelete($id) {
        DB::delete('DELETE FROM '.$this->table.' WHERE USER_ID = ?', [$id]);
    }

    public function updateUser($data, $id) {
        $data[] = $id;
        return DB::update('UPDATE '.$this->table.' SET fullname = ?, email = ?, birthday = ?, user_avatar = ?, gender = ?, update_at = ? WHERE USER_ID = ?', $data);
    }

    public function authUser($username, $password) {
        return DB::select('SELECT * FROM '.$this->table.' WHERE USERNAME = ? AND PASSWORD = ?', [$username, $password]);
    }
}
