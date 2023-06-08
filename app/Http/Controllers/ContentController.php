<?php

namespace App\Http\Controllers;

use App\Models\Comics;
use App\Models\Contents;
use Illuminate\Http\Request;
use App\Models\Chapters;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use League\Flysystem\FileAttributes;
use Nette\Utils\DateTime;

class ContentController extends Controller
{
    private $chapters;
    private $comics;
    private $contents;

    function __construct()
    {
        $this->chapters = new Chapters();
        $this->comics = new Comics();
        $this->contents = new Contents();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        ini_set('max_execution_time', 600);
    }
    public function index(Request $request, $id) {
        $filesId = [];
        
        $data = $this->chapters->getChapterDetails($id);
        $dataContent = $this->contents->getContentByIdChapter($id);

        $ids = [];

        foreach ($dataContent as $value) {
            $ids[] = $value->CONTENT_ID;
        }
        
        if (!empty($data[0])) {
            $data = $data[0];
            $comicDetails = $this->comics->getComicDetails($data->COMIC_ID);
            if (!empty($comicDetails[0])) {
                $comicDetails = $comicDetails[0];
            }
        } else {
            return redirect()->back();
        }
        $contents = $this->contents->getContentByIdChapter($id);
        if (!empty($contents) && $comicDetails->TYPE == 'Comic') {
            // $dir = 'project/'.$comicDetails->COMIC_ID.'/'.$data->CHAPTER_ID;

            foreach ($contents as $value) {
                $paths[] = $value->FILE_PATH;
            }
            // dd($urls);
            foreach ($paths as $value) {
                $googleUrls[] = Storage::disk('google')->url($value);
            }

            if (count($googleUrls) == count($ids)) {
                for ($i = 0; $i < count($googleUrls); $i++) {
                    $this->contents->updateGGDriveId($googleUrls[$i], $ids[$i]);
                }
            }
            
        }
        $dataContentNew = $this->contents->getContentByIdChapter($id);
        return view('admin.content.contents')->with([
            'id' => $id,
            'comicDetails' => $comicDetails,
            'dataContentNew' => $dataContentNew,
            'chapterName' => $data->CHAPTER_NAME,
            'type' => $comicDetails->TYPE
        ]);
    }

    public function addContent($id) {
        $title = 'Add Content';
        $chapterName = $this->chapters->getChapterDetails($id);
        if (!empty($chapterName[0])) {
            $chapterName = $chapterName[0];
            $comics = $this->comics->getComicDetails($chapterName->COMIC_ID);
            if (!empty($comics[0])) {
                $comics = $comics[0];
                if ($comics->TYPE == 'Comic') {
                    return view('admin.content.contents-form')->with([
                        'id' => $id,
                        'title' => $title,
                        'chapter_name' => $chapterName->CHAPTER_NAME
                    ]);
                } else if ($comics->TYPE == 'Light-Novel') {
                    return view('admin.content.contents-form-light-novel')->with([
                        'id' => $id,
                        'title' => $title,
                        'chapter_name' => $chapterName->CHAPTER_NAME
                    ]);
                }
            }
        }

        
    }

    public function postAddContent(Request $request) {
        $chapterDetails = $this->chapters->getChapterDetails($request->id_chapter);
        $comicDetails = $this->comics->getComicDetails($chapterDetails[0]->COMIC_ID);

        $comicId = $comicDetails[0]->COMIC_ID;
        $project = 'project';
        $chapterId = $request->id_chapter;      
        
        if ($request->hasFile('file_upload')) {
            $files = $request->file('file_upload');
            foreach ($files as $value) {
                $fileData[] = File::get($value);
            }
            // dd(count($fileData));
            $now = DateTime::createFromFormat('U.u', microtime(true));
            // dd($now->format("YmdHisu"));
            $k = 0;
            if (!empty($fileData)) {
                for ($i=0; $i<count($fileData); $i++) { 
                    $fileName = $k.'_'.$now->format("YmdHis").'.png';
                    $path = $project.'/'.$comicId.'/'.$chapterId.'/'.$fileName;
                    $data = [
                        $chapterDetails[0]->CHAPTER_ID,
                        $path
                    ];
                    $this->contents->addContent($data);
                    Storage::disk('google')->put($path, $fileData[$i]);
                    unset($data);
                    $k++;
                    if ($i == (count($fileData) - 1)) {
                        return redirect()->route('admin.contents.manage-content', ['id' => $request->id_chapter])->with('msg-success', 'Thêm nội dung thành công');
                    }
                }
            } else {
                return redirect()->route('admin.contents.manage-content', ['id' => $request->id_chapter])->with('msg-danger', 'No content');
            }           
        }

        if ($comicDetails[0]->TYPE == 'Light-Novel') {
            $data = [
                $chapterId,
                $request->content
            ];
            if (!empty($data)) {
                $this->contents->addContentLightNovel($data);
                return redirect()->route('admin.contents.manage-content', ['id' => $request->id_chapter])->with('msg-success', 'Thêm nội dung thành công');
            } else {
                return redirect()->route('admin.contents.manage-content', ['id' => $request->id_chapter])->with('msg-danger', 'No content');
            }
            
        }
    }

    public function deleteContent($id) {

        $contentDetails = $this->contents->getContentByIdContent($id);
        $chapterDetails = $this->chapters->getChapterDetails($contentDetails[0]->CHAPTER_ID);
        $comicDetails = $this->comics->getComicDetails($chapterDetails[0]->COMIC_ID);

        if ($comicDetails[0]->TYPE == 'Comic') {
            $googleServiceAPI = Storage::disk('google');
            $contentDetails = $this->contents->getContentByIdContent($id);
            
            if(!empty($contentDetails)) {
                $path = $contentDetails[0]->FILE_PATH;
                // dd($path);
                $delete = $googleServiceAPI->delete($path); 
                if ($delete == 1) {
                    $this->contents->removeContent($id);
                    return back()->with('msg-success', 'Xoá thành công');
                } else {
                    return back()->with('msg-danger', 'Xoá thất bại');
                }
            }
        }
        if ($comicDetails[0]->TYPE == 'Light-Novel') {
            $this->contents->removeContent($id);
            return back()->with('msg-success', 'Xoá thành công');
        }
        
    }  
}
