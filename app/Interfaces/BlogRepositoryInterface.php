<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
    public function getAllBlogs();
    public function getBlogById($blogId);
    public function getLastBlog();
    public function getAllBlogsByLatestWithPaginate($paginateNumber);
    public function getAllUserBlogsByLatestWithPaginate($paginateNumber, $userId);
    public function deleteBlog($blogId);
    public function createBlog($title, $content, $userId);
    public function updateBlog($blogId, $title, $content);
}
