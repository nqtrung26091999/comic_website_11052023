<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\Comics;
use App\Models\Chapters;
use App\Models\Contents;
use App\Models\History;
use App\Models\HoldCategory;
use App\Models\Users;

use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $categories;
    private $comics;
    private $chapters;
    private $contents;
    private $holdings;
    private $users;
    private $history;

    public function __construct() {
        $this->categories = new Categories();
        $this->comics = new Comics();
        $this->chapters = new Chapters();
        $this->contents = new Contents();
        $this->holdings = new HoldCategory();
        $this->users = new Users();
        $this->history = new History();
    }

    public function index(Request $request) {
        $categories = $this->categories->getAllCategories();
        $comics = DB::table('comics')->paginate(6);
        $user = $request->session()->get('user');
        if ($user) {
            $histories = $this->getHistory($user->USER_ID);
        } else {
            $histories = [];
        }
        
        return view('client.home.home', compact(['comics', 'categories', 'histories']));
    }

    public function readComic($id) {
        $comicDetails = $this->comics->getComicDetails($id);
        $chapters = $this->chapters->getAllChaptersByIdComic($id);
        $categories = $this->holdings->getByIdComic($id);

        if (!empty($comicDetails)) {
            $comicDetails = $comicDetails[0];
        }

        return view('client.pages.page-comic-read')->with([
            'comics' => $comicDetails,
            'chapters' => $chapters,
            'categories' => $categories
        ]);
    }

    public function readChapter(Request $request, $id) {
        if ($request->session()->get('user')) {
            $userId = $request->session()->get('user')->USER_ID;
            $this->history->createHistory([
                'USER_ID' => $userId,
                'CHAPTER_ID' => $id
            ]);
        }
        
        $disabled = '';
        $chapters = $this->chapters->getChapterDetails($id);
        $comics = $this->comics->getComicDetails($chapters[0]->COMIC_ID);
        $chapterAll = $this->chapters->getAllChaptersByIdComic($chapters[0]->COMIC_ID);

        if ($chapterAll[0]->CHAPTER_ID == $id) {
            $disabled = 'disabled-prev';
        }

        if ($chapterAll[count($chapterAll)-1]->CHAPTER_ID == $id) {
            $disabled = 'disabled-next';
        }
        
        $contents = $this->contents->getContentByIdChapter($id);
        if ($comics[0]->TYPE == 'Comic') {
            return view('client.pages.read-chapter')->with([
                'contents' => $contents,
                'comics' => $comics[0],
                'chapters' => $chapters[0],
                'typeComic' => $comics[0]->TYPE,
                'chapterAll' => $chapterAll,
                'disabled' => $disabled
            ]);
        }

        if ($comics[0]->TYPE == 'Light-Novel') {
            return view('client.pages.read-chapter')->with([
                'contents' => $contents[0],
                'comics' => $comics[0],
                'chapters' => $chapters[0],
                'typeLightNovel' => $comics[0]->TYPE
            ]);
        }

    }

    public function readChapterNext(Request $request) {
        $comicId = $request->comic_id;
        $chapterId = $request->id;
        $chapterAll = $this->chapters->getAllChaptersByIdComic($comicId);
        for ($i=0; $i < count($chapterAll); $i++) { 
            if ($chapterAll[$i]->CHAPTER_ID == $chapterId) {
                $id = $chapterAll[$i + 1]->CHAPTER_ID;
            }
        }
        return redirect()->route('read-chapter', ['id' => $id]);
    }

    public function readChapterPrev(Request $request) {
        $comicId = $request->comic_id;
        $chapterId = $request->id;
        $chapterAll = $this->chapters->getAllChaptersByIdComic($comicId);
        for ($i=0; $i < count($chapterAll); $i++) { 
            if ($chapterAll[$i]->CHAPTER_ID == $chapterId) {
                $id = $chapterAll[$i - 1]->CHAPTER_ID;
            }
        }
        return redirect()->route('read-chapter', ['id' => $id]);
    }

    public function login() {
        return view('client.pages.login');
    }

    public function postLogin(Request $request) {

        $username = $request->username;
        $password = $request->password;

        $request->validate([
            'username' =>'required',
            'password' =>'required'
        ],[
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);

        $dataAuth = $this->users->authUser($username, $password);
        // dd($dataAuth);
        if(!empty($dataAuth)) {
            $request->session()->put('user',$dataAuth[0]);
            // dd(session('user'));
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('msg', 'Sai tên đăng nhập hoặc mật khẩu');
        }
        // return view('client.pages.login')->with('msg', 'Login failed');
    }

    public function register() {
        return view('client.pages.register');
    }

    public function postRegister(Request $request) {
        $repeatPassword = $request->repeat_password;
        $data = [
            $request->username,
            $request->password,
            $request->email
        ];

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'repeat_password' => 'required'
        ],[
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'repeat_password.required' => 'Vui lòng nhập xác minh mật khẩu',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email'
        ]);

        if ($request->argument == 'on') {
            if ($repeatPassword == $data[1]) {
                $this->users->registerUser($data);
                $dataAuth = $this->users->authUser($data[0], $data[1]);
                if(!empty($dataAuth)) {
                    $request->session()->put('user',$dataAuth[0]);
                    return redirect()->route('index');
                }
            }
        } else {
            $msg = 'Vui lòng chấp nhận điều khoản';
            return redirect()->route('register')->with('msg', $msg);
        }
        
    }

    public function forgotPassword() {
        return view('client.pages.forgot-password');
    }

    public function searchCategory($id) {
        $data = $this->holdings->getByIdCategory($id);
        $categories = $this->categories->getAllCategories();

        $data = DB::table('comics')
        ->join('hold', 'hold.COMIC_ID', '=', 'comics.COMIC_ID')
        ->where('hold.CATEGORY_ID',$id)
        ->get();
        $perPage = 6;
        $page = 1;

        $comics = new LengthAwarePaginator($data->forPage($page, $perPage), $data->count(), $perPage);
        
        return view('client.home.home')->with([
            'comics' => $comics,
            'categories' => $categories
        ]);
    }

    public function logoutUser(Request $request) {
        $value = $request->session()->pull('user');
        if (!empty($value)) {
            return redirect()->route('login');
        }
    }

    public function profileUser($id) {
        $userDetails = $this->users->getDetail($id);
        $data = $this->getHistory($id);
        return view('client.pages.profile')->with([
            'userDetails' => $userDetails,
            'histories' => $data
        ]);
    }

    public function getHistory($id) {
        $usersHistory = $this->history->getHistoryByIdUser($id);
        $data = Array();
        foreach ($usersHistory as $value) {
            array_push($data, (DB::table('chapters')
            ->select()
            ->crossJoin('comics', 'chapters.COMIC_ID', 'comics.COMIC_ID')
            ->where('chapters.CHAPTER_ID', $value->CHAPTER_ID)
            ->get())[0]);
        }
        $collection = collect($data)->sortBy('COMIC_NAME')->reverse()->toArray();
        return $collection;
    }

    public function removeHistory(Request $request, $id) {
        if ($request->session()->get('user')) {
            $this->history->deleteHistory($id);
            return redirect()->back();
        }
        dd();
    }
}
