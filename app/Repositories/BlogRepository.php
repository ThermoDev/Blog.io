<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{
    // protected $user;

    // public function __construct(Blog $blog, User $user)
    // {
    //     $this->user = $user;
    // }

    public function getAllBlogs()
    {
        return Blog::latest()->all();
    }

    public function getBlogById($blogId)
    {
        return Blog::findOrFail($blogId);
    }

    public function getLastBlog()
    {
        return Blog::last();
    }

    public function getAllBlogsByLatestWithPaginate($paginateNumber)
    {
        return Blog::latest()->paginate($paginateNumber);
    }

    public function deleteBlog($blogId)
    {
        return Blog::destroy($blogId);
    }

    public function createBlog($title, $content, $userId)
    {
        return Blog::create([
            "title" => $title,
            "content" => $content,
            "user_id" => $userId
        ]);
    }

    public function updateBlog($blogId, $title, $content)
    {
        return Order::whereId($blogId)->update(["title" => $title, "content" => $content]);
    }
}