<?php

namespace App\Http\Controllers;

use App\Models\Comics;
use App\Models\Categories;
use App\Models\HoldCategory;
use Illuminate\Http\Request;
use \stdClass;
use Storage;
use App\Document;
use File;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class ComicsController extends Controller
{
    private $comics;
    private $categories;
    private $holdCategory;
    function __construct()
    {
        $this->comics = new Comics();
        $this->categories = new Categories();
        $this->holdCategory = new HoldCategory();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }
    public function index() {
        $allComics = $this->comics->getAllComics();
        return view('admin.comic.comics', compact('allComics'));
    }

    public function addComic() {
        $title = 'Add comic';
        return view('admin.comic.comics-form')->with(['title' => $title]);
    }

    public function postAddComic(Request $request) {
        
        $data = [];

        $request->validate([
            'comic_name' => 'required',
        ]);

        
        $data = [
            $request->user_id,
            $request->comic_name,
            $request->short_description,
            $request->type_comic,
        ];

        $this->comics->addComic($data);
        return redirect()->route('admin.comics.manage-comic')->with('msg-success', 'Thêm Truyện thành công');
    }

    public function deleteComic($id) {
        // dd('del');
        if (!empty($id)) {
            $comicDetail = $this->comics->getComicDetails($id);
            if (!empty($comicDetail[0])) {
                $this->comics->removeComic($id);
            } else {
                return redirect()->route('admin.comics.manage-comic')->with('msg-danger', 'Truyện này không tồn tại');
            }
        } else {
            return redirect()->route('admin.comics.manage-comic')->with('msg-warning', 'Liên kết không tồn tại');
        }
        // dd($detail);
        return redirect()->route('admin.comics.manage-comic')->with('msg-success', 'Xoá truyện thành công');
    }

    public function editComic(Request $request, $id) {
        $title = 'Edit comic';
        $allData = $this->categories->getAllCategories();
        $holdingData = $this->holdCategory->getAllHoldCategory();

        if (!empty($id)) {
            $comicDetails = $this->comics->getComicDetails($id);
            if (!empty($comicDetails[0])) {
                $request->session()->put('id', $id);
                $comicDetails = $comicDetails[0];
            } else {
                return redirect()->route('admin.comics.manage-comic')->with('msg', 'Thể loại này không tồn tại');
            }
        } else {
            return redirect()->route('admin.comics.manage-comic')->with('msg', 'Liên kết không tồn tại');
        }
        
        return view('admin.comic.edit-comics', compact('comicDetails', 'allData', 'holdingData'))->with('title', $title);
    }

    public function postEditComic(Request $request) {

        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            'comic_name' => 'required',
            'short_description' => 'required'
        ]);

        $comicDetails = $this->comics->getComicDetails($id);
        if ($request->hasFile('cover')) {
            if ($request->file('cover')->isValid()) {
                try {
                    $file = $request->file('cover');
                    $cover = base64_encode(file_get_contents($file));

                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        } else {
            $cover = $comicDetails[0]->COVER;
        }

        $dataUpdate = [
            $request->user_id,
            $request->comic_name,
            $request->short_description,
            $request->type_comic,
            $cover,
            date('Y-m-d H:i:s', time())
        ];

        $ids = $request->holding_category;
        $elements = $this->holdCategory->getByIdComic($id);
        $count = count($elements);

        if (!empty($ids)) {
            if ($count == count($ids)) {
                // return redirect()->back();
            } elseif ($count > count($ids)) {
                for ($i=0; $i < count($elements); $i++) { 
                    for ($j=0; $j < count($ids); $j++) { 
                        if ($elements[$i]->CATEGORY_ID != (int)$ids[$j]) {
                            $this->holdCategory->deleteByIdComicAndCategory($id, $elements[$i]->CATEGORY_ID);
                        }
                        // dd($elements[$i]->CATEGORY_ID);
                    }
                }
            }

            foreach ($ids as $value) {
                $names[] = $this->categories->getCategoryDetail($value);
            }
            $dataObj = new stdClass();

            for ($i=0; $i < count($names); $i++) { 
                $dataObj = $names[$i][0];
                $tmp[] = $dataObj->CATEGORY_NAME;
            }

            for ($i=0; $i < count($ids) ; $i++) { 
                if (count($this->holdCategory->getByIdComicAndCategory($id, $ids[$i])) <= 0) {
                    $this->holdCategory->addCategories($id, $ids[$i], $tmp[$i]);
                }
            }
        } else {
            $this->holdCategory->deleteByIdComic($id);
        }
        
        $this->comics->updateComic($dataUpdate, $id);

        return redirect()->route('admin.comics.manage-comic')->with('msg-success', 'Cập nhật truyện thành công');
    }
}
