<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Storage;
use App\Document;
use File;

class CategoryController extends Controller
{
    private $categories;
    function __construct()
    {
        $this->categories = new Categories();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }
    public function index() {

        $allCate = $this->categories->getAllCategories();

        return view('admin.category.categories', compact('allCate'));
    }

    public function addCate() {
        $title = 'Add category';
        return view('admin.category.categories-form')->with('title', $title);
    }

    public function postAddCate(Request $request) {

        $request->validate([
            'category_name' => 'required',
            'description' => 'required'
        ]);

        $data = [
            $request->category_name,
            $request->description
        ];

        $this->categories->addCategory($data);
        return redirect()->route('admin.categories.manage-category')->with('msg-success', 'Thêm thể loại thành công');
    }

    public function deleteCategory($id) {
        // dd('del');
        if (!empty($id)) {
            $categoryDetail = $this->categories->getCategoryDetail($id);
            if (!empty($categoryDetail[0])) {
                $this->categories->deleteCategory($id);
            } else {
                return redirect()->route('admin.categories.manage-category')->with('msg-danger', 'Thể loại này không tồn tại');
            }
        } else {
            return redirect()->route('admin.categories.manage-category')->with('msg-warning', 'Liên kết không tồn tại');
        }
        // dd($detail);
        return redirect()->route('admin.categories.manage-category')->with('msg-success', 'Xoá thể loại thành công');
    }

    public function editCategory(Request $request, $id) {
        if (!empty($id)) {
            $categoryDetails = $this->categories->getCategoriesDetails($id);
            if (!empty($categoryDetails[0])) {
                $request->session()->put('id', $id);
                $categoryDetails = $categoryDetails[0];
            } else {
                return redirect()->route('admin.index')->with('msg', 'Thể loại này không tồn tại');
            }
        } else {
            return redirect()->route('admin.index')->with('msg', 'Liên kết không tồn tại');
        }
        return view('admin.category.edit-categories', compact('categoryDetails'));
    }

    public function postEditCategory(Request $request) {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            'category_name' => 'required',
            'description' => 'required'
        ]);
            $dataUpdate = [
                $request->category_name,
                $request->description,
                date('Y-m-d H:i:s', time())
            ];

        $this->categories->updateCategory($dataUpdate, $id);

        return redirect()->route('admin.categories.manage-category')->with('msg-success', 'Cập nhật thể loại thành công');
    }
}
