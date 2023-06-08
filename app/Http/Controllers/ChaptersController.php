<?php

namespace App\Http\Controllers;

use App\Models\Comics;
use App\Models\Chapters;
use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    private $comics;
    private $chapters;
    private $holdCategory;
    function __construct()
    {
        $this->comics = new Comics();
        $this->chapters = new Chapters();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }
    public function index(Request $request) {
        $title = 'Manage Chapter';
        $comicDetails = $this->comics->getComicDetails($request->id);
        
        if (!empty($comicDetails)) {
            $comicDetails = $comicDetails[0];
        }
        $idComic = $comicDetails->COMIC_ID;
        // dd($idComic);

        $allChapters = $this->chapters->getAllChaptersByIdComic($idComic);
        // dd($comicDetails);
        return view('admin.chapter.chapters')->with([
            'title' => $title,
            'comicDetails' => $comicDetails,
            'allChapters' => $allChapters,
        ]);
    }

    public function addChapter(Request $request) {
        $comicId = $request->id;
        $chapter = $request->chapter;

        $title = 'Add Chapter';
        return view('admin.chapter.chapters-form')->with([
            'title' => $title,
            'comicId' => $comicId,
            'chapter' => $chapter
        ]);
    }

    public function postAddChapter(Request $request) {

        $id = $request->comic_id;
        $request->validate([
            'chapter_name' => 'required',
        ]);

        $data = [
            $id,
            $request->chapter_name
        ];

        if (!empty($data)) {
            $this->chapters->addChapter($data);
            $total = $this->chapters->getAllChaptersByIdComic($request->comic_id);
            $dataUpdateTotalChapters = [
                count($total),
                date('Y-m-d H:i:s', time())
            ];
            $this->comics->updateTotalChapters($dataUpdateTotalChapters,$id);
        }

        
        return redirect()->route('admin.comics.manage-comic')->with('msg-success', 'Thêm chapter thành công');
    }

    public function deleteChapter($id) {
        if (!empty($id)) {
            $chapterDetail = $this->chapters->getChapterDetails($id);
            if (!empty($chapterDetail[0])) {
                $idComic = $chapterDetail[0]->COMIC_ID;
                $chapterDetail = $chapterDetail[0];
                $this->chapters->removeChapter($id, $idComic);
                $chapters = $this->chapters->getAllChaptersByIdComic($chapterDetail->COMIC_ID);
                $data = [
                    count($chapters),
                    date('Y-m-d H:i:s', time())
                ];
                $comicId = $chapterDetail->COMIC_ID;
                $this->comics->updateTotalChapters($data ,$comicId);
            } else {
                return redirect()->back()->with('msg-danger', 'Chapter này không tồn tại');
            }
        } else {
            return redirect()->back()->with('msg-warning', 'Liên kết không tồn tại');
        }
        // dd($detail);
        return redirect()->back()->with('msg-success', 'Xoá chapter thành công');
    }

    public function editChapter($id) {
        $title = 'Edit Chapter';
        if (!empty($id)) {
            $chapterDetails = $this->chapters->getChapterDetails($id);
            // dd($chapterDetail);
            if (!empty($chapterDetails[0])) {
                $chapterDetails = $chapterDetails[0];
                return view('admin.chapter.edit-chapters', compact('chapterDetails'))->with('title', $title);
            }
        }
    }

    public function postEditChapter(Request $request) {
        if (!empty($request)) {
            $data = [
                $request->chapter_name,
                date('Y-m-d H:i:s', time()),
                $request->chapter_id
            ];
            // dd($data); 
            if (!empty($data)) {
                $this->chapters->updateChapter($data);
                return redirect()->route('admin.chapters.manage-chapter', ['id' => $request->comic_id])->with('msg-success', 'Chapter cập nhật thành công');
            } else {
                return redirect()->back()->with('msg-warning', 'Liên kết không tồn tại');
            }
            
        } else {
            return redirect()->back()->with('msg-danger', 'Chapter không tồn tại');
        }
    }
}
