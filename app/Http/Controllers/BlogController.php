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

        $editable = false;

        // Allow edits
        if (auth()->user() && auth()->user()->id == $blog->user->id) {
            $editable = true;
        }

        return view('blogs.view', ["blog" => $blog, "editable" => $editable]);
    }

    public function createBlog()
    {
        return view('blogs.create');
    }

    public function editBlog($blogId)
    {
        $blog = $this->blogRepository->getBlogById($blogId);

        if (auth()->user()->id != $blog->user->id) {
            activity()->causedBy(auth()->user())->log("A user attempted to edit a blog with the ID: {$blogId}");
            return redirect()->route('blogs')->with('msg', 'Unauthorized access... Nice try!');
        }

        return view('blogs.edit', ["blog" => $blog]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog = $this->blogRepository->createblog($request->title, $request->content, $request->user()->id);

        activity()->causedBy(auth()->user())->log("A user created a blog with the ID: {$blog->id}");

        return redirect()->route('blog', ["blogId" => $blog->id]);
    }

    public function patch($blogId, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog = $this->blogRepository->getBlogById($blogId);

        if (auth()->user()->id != $blog->user->id) {
            activity()->causedBy(auth()->user())->log("A user attempted to patch a blog with the ID: {$blogId}");
            return redirect()->route('blogs')->with('msg', 'Unauthorized access... Nice try!');
        }

        $blog = $this->blogRepository->updateBlog($blogId, $request->title, $request->content);
        activity()->causedBy(auth()->user())->log("A user updated a blog with the ID: {$blogId}");
        return redirect()->route('blog', ["blogId" => $blogId])->with('success', 'Blog updated successfully!');;
    }
}
