<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Config;
use Response;
use App\Models\Tag;
use App\Models\Category;
use Str;
use Event;
use Image;
use File;
use App\Repositories\RepositoryAbstract;
use App\Repositories\CrudableInterface as CrudableInterface;
use App\Exceptions\Validation\ValidationException;

/**
 * Class PostRepository.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class PostRepository extends RepositoryAbstract implements PostInterface, CrudableInterface
{
    protected $width;
    protected $height;
    protected $thumbWidth;
    protected $thumbHeight;
    protected $imgDir;
    protected $perPage;
    protected $post;
    /**
     * Rules.
     *
     * @var array
     */
    protected static $rules = [
        // 'title' => 'required',
        'content' => 'required',
    ];

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $config = Config::get('fully');
        $this->perPage = 10;//$config['per_page'];
        $this->width = 460;//$config['modules']['post']['image_size']['width'];
        $this->height = 270;//$config['modules']['post']['image_size']['height'];
        $this->thumbWidth = 32;//$config['modules']['post']['thumb_size']['width'];
        $this->thumbHeight = 32;//$config['modules']['post']['thumb_size']['height'];
        $this->imgDir = '/uploads/posts/';//$config['modules']['post']['image_dir'];
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->post->with('tags')->orderBy('created_at', 'DESC')->where('is_published', 1)->get();
    }

    /**
     * @param $limit
     *
     * @return mixed
     */
    public function getLastPost($limit)
    {
        return $this->post->orderBy('created_at', 'desc')->take($limit)->offset(0)->get();
    }

    /**
     * @param $limit
     *
     * @return mixed
     */
    public function getHotPosts($limit)
    {
        return $this->post->orderBy('created_at', 'desc')->where('is_hot', 1)->take($limit)->offset(0)->get();
    }

    /**
     * @return mixed
     */
    public function lists()
    {
        return $this->post->get()->lists('title', 'id');
    }

    /*
    public function paginate($perPage = null, $all = false) {

        if ($all)
            return $this->post->with('tags')->orderBy('created_at', 'DESC')
                ->paginate(($perPage) ? $perPage : $this->perPage);

        return $this->post->with('tags')->orderBy('created_at', 'DESC')
            ->where('is_published', 1)
            ->paginate(($perPage) ? $perPage : $this->perPage);
    }
    */

    /**
     * Get paginated posts.
     *
     * @param int  $page  Number of posts per page
     * @param int  $limit Results per page
     * @param bool $all   Show published or all
     *
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function paginate($page = 1, $limit = 10, $all = false)
    {
        $result = new \StdClass();
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->post->with('tags')->orderBy('created_at', 'DESC');

        if (!$all) {
            $query->where('is_published', 1);
        }

        $posts = $query->skip($limit * ($page - 1))->take($limit)->get();

        $result->totalItems = $this->totalPosts($all);
        $result->items = $posts->all();

        return $result;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->post->with(['tags', 'category'])->findOrFail($id);
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getBySlug($slug)
    {
        return $this->post->with(['tags', 'category'])->where('slug', $slug)->first();
    }

    /**
     * @param $attributes
     *
     * @return bool|mixed
     *
     * @throws \App\Exceptions\Validation\ValidationException
     */
    public function create($attributes)
    {
        $attributes['is_published'] = isset($attributes['is_published']) ? true : false;

        if ($this->isValid($attributes)) {

            $this->post->user_id = auth()->getUser()->id;
            if ($this->post->fill($attributes)->save()) {
                $category = Category::find($attributes['category']);
                $category->posts()->save($this->post);
            }

            $postTags = explode(',', $attributes['tag']);

            foreach ($postTags as $postTag) {
                if (!$postTag) {
                    continue;
                }

                $tag = Tag::where('name', '=', $postTag)->first();

                if (!$tag) {
                    $tag = new Tag();
                }

                // $tag->lang = $this->getLang();
                $tag->name = $postTag;
                //$tag->slug = Str::slug($postTag);

                $this->post->tags()->save($tag);
            }

            //Event::fire('post.created', $this->post);
            Event::fire('post.creating', $this->post);

            return true;
        }
        throw new ValidationException('Post validation failed', $this->getErrors());
    }

    /**
     * @param $id
     * @param $attributes
     *
     * @return bool|mixed
     *
     * @throws \App\Exceptions\Validation\ValidationException
     */
    public function update($id, $attributes)
    {
        $this->post = $this->find($id);
        $attributes['is_published'] = isset($attributes['is_published']) ? true : false;

        if ($this->isValid($attributes)) {

            //-------------------------------------------------------
            /*if (isset($attributes['image'])) {
                $file = $attributes['image'];

                // delete old image
                $destinationPath = public_path().$this->imgDir;
                File::delete($destinationPath.$this->post->file_name);
                File::delete($destinationPath.'thumb_'.$this->post->file_name);

                $destinationPath = public_path().$this->imgDir;
                $fileName = $file->getClientOriginalName();
                $fileSize = $file->getClientSize();

                $upload_success = $file->move($destinationPath, $fileName);

                if ($upload_success) {

                    // resizing an uploaded file
                    Image::make($destinationPath.$fileName)->resize($this->width, $this->height)->save($destinationPath.$fileName);

                    // thumb
                    Image::make($destinationPath.$fileName)->resize($this->thumbWidth, $this->thumbHeight)->save($destinationPath.'thumb_'.$fileName);

                    $this->post->file_name = $fileName;
                    $this->post->file_size = $fileSize;
                    $this->post->path = $this->imgDir;
                }
            }*/
            //-------------------------------------------------------

            if ($this->post->fill($attributes)->save()) {
                $this->post->resluggify();
                $category = Category::find($attributes['category']);
                $category->posts()->save($this->post);
            }

            $postTags = explode(',', $attributes['tag']);

            foreach ($postTags as $postTag) {
                if (!$postTag) {
                    continue;
                }

                $tag = Tag::where('name', '=', $postTag)->first();

                if (!$tag) {
                    $tag = new Tag();
                }

                $tag->lang = $this->getLang();
                $tag->name = $postTag;
                //$tag->slug = Str::slug($postTag);
                $this->post->tags()->save($tag);
            }

            return true;
        }

        throw new ValidationException('Post validation failed', $this->getErrors());
    }

    /**
     * @param $id
     *
     * @return mixed|void
     */
    public function delete($id)
    {
        $post = $this->post->findOrFail($id);
        $post->tags()->detach();
        $post->delete();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function togglePublish($id)
    {
        $post = $this->post->find($id);

        $post->is_published = ($post->is_published) ? false : true;
        $post->save();

        return Response::json(array('result' => 'success', 'changed' => ($post->is_published) ? 1 : 0));
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function getUrl($id)
    {
        $post = $this->post->findOrFail($id);

        return url('post/'.$id.'/'.$post->slug, $parameters = array(), $secure = null);
    }

    /**
     * Get total post count.
     *
     * @param bool $all
     *
     * @return mixed
     */
    protected function totalPosts($all = false)
    {
        if (!$all) {
            return $this->post->where('is_published', 1)->count();
        }

        return $this->post->count();
    }
}
