<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class UsersController extends Controller
{
    private $users;

    function __construct()
    {
        $this->users = new Users();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    public function index()
    {
        $allUsers = $this->users->getAll();
        return view('admin.users', compact('allUsers'));
    }

    public function postAdd(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users',
            'fullname' => 'required|min:6',
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'birthday' => 'required',
        ]);

        $data = [
            $request->username,
            $request->password,
            $request->fullname,
            $request->birthday,
            $request->email,
            $request->account_type
        ];

        $this->users->addUser($data);
        return redirect()->route('admin.users.manage-user')->with('msg-success', 'Thêm người dùng thành công');
    }

    public function getPofile(Request $request, $id = 0)
    {

        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'Người dùng này không tồn tại');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }
        // dd($detail);
        return view('admin.profile', compact('userDetail'));
    }

    public function delete($id = 0)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $this->users->getDelete($id);
            } else {
                return redirect()->route('admin.users.manage-user')->with('msg-danger', 'Người dùng này không tồn tại');
            }
        } else {
            return redirect()->route('admin.users.manage-user')->with('msg-warning', 'Liên kết không tồn tại');
        }
        // dd($detail);
        return redirect()->route('admin.users.manage-user')->with('msg-success', 'Xoá người dùng thành công');
        ;
    }

    public function postProfile(Request $request)
    {
        $id = session('id');
        $userDetail = $this->users->getDetail($id);
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            'fullname' => 'required|min:6',
            'email' => 'required|email'
        ]);
        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                try {
                    $file = $request->file('avatar');
                    $image = base64_encode(file_get_contents($file));

                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        } else {
            $image = $userDetail[0]->USER_AVATAR;
        }

            $dataUpdate = [
                $request->fullname,
                $request->email,
                $request->birthday,
                $image,
                date('Y-m-d H:i:s', time())
            ];

        $this->users->updateUser($dataUpdate, $id);

        return redirect()->route('admin.users.manage-user')->with('msg-success', 'Cập nhật người dùng thành công');
    }
}