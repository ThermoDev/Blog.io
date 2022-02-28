<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogRepositoryInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $blogs = $this->blogRepository->getAllBlogsByLatestWithPaginate(20);
        return view('blogs.index', ["blogs" => $blogs]);
    }

    public function viewBlog($blogId)
    {
        $blog = $this->blogRepository->getBlogById($blogId);


        // Allow edits
        if(auth()->user()->id == $blog->user->id){
            // dd("Nothing");
        }

        return view('blogs.view', ["blog" => $blog]);
    }

    public function createBlog()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|max:255',
        ]);

        $blog = $this->blogRepository->createblog($request->title, $request->content, $request->user()->id);
        return redirect()->route('blog', ["blogId" => $blog->id]);
    }
}
