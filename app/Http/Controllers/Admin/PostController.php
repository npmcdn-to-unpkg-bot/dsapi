<?php

namespace App\Http\Controllers\Admin;

use View;
use Flash;
use Input;
use Response;
use App\Services\Pagination;
use App\Http\Controllers\Controller;
use App\Repositories\Post\PostInterface;
use App\Repositories\Category\CategoryInterface;
use App\Exceptions\Validation\ValidationException;
use App\Repositories\Post\PostRepository as Post;
use App\Repositories\Category\CategoryRepository as Category;

class PostController extends Controller
{
    
    protected $post;
    protected $category;
    protected $perPage;

    public function __construct(PostInterface $post, CategoryInterface $category)
    {
        View::share('active', 'blog');
        $this->post = $post;
        $this->category = $category;

        $this->perPage = 10;//config('fully.modules.post.per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pagiData = $this->post->paginate(Input::get('page', 1), $this->perPage, true);
        $posts = Pagination::makeLengthAware($pagiData->items, $pagiData->totalItems, $this->perPage);

        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->category->lists();

        return view('backend.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $this->post->create(Input::all());
            flash()->message('Post was successfully added');

            return langRedirectRoute('admin.post.index');
        } catch (ValidationException $e) {
            return langRedirectRoute('admin.post.create')->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->post->find($id);

        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);
        $tags = null;

        foreach ($post->tags as $tag) {
            $tags .= ','.$tag->name;
        }

        $tags = substr($tags, 1);
        $categories = $this->category->lists();

        return view('backend.post.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        try {
            $this->post->update($id, Input::all());
            flash()->message('Post was successfully updated');

            return langRedirectRoute('admin.post.index');
        } catch (ValidationException $e) {
            return langRedirectRoute('admin.post.edit')->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->post->delete($id);
        flash()->message('Post was successfully deleted');

        return langRedirectRoute('admin.post.index');
    }

    public function confirmDestroy($id)
    {
        $post = $this->post->find($id);

        return view('backend.post.confirm-destroy', compact('post'));
    }

    public function togglePublish($id)
    {
        return $this->post->togglePublish($id);
    }
}
