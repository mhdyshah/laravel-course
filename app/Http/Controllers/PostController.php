<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = DB::select('SELECT * from posts where id = ?', [10]);
        // $posts = DB::update('UPDATE posts set body = ? where id = ?', ['Body test', 50]);
        // $posts = DB::delete('DELETE FROM posts WHERE id=?', [50]);
        // $posts = DB::table('posts')->whereBetween("id", array(10, 20))->select("title", 'body')->orderBy('id')->get();
        // $posts = DB::table('posts')->find('44');
        // $posts = DB::table('posts')->find('44', 'title');
        // $posts = DB::table('posts')->where('is_published', false)->get('title');
        // $posts = DB::table('posts')->where('is_published', false)->value('title');
        // $posts = DB::table('posts')->where('id', '>', 68)->count();
        // $posts = DB::table('posts')->min('min_to_read');
        // $posts = DB::table('posts')->sum('min_to_read');
        // $posts = DB::table('posts')->avg('min_to_read');
        // dd($posts);


        // return view("blog.index", [
        //     'posts' => $posts
        // ]);

        // return view("blog.index", [
        //     'posts' => DB::table('posts')->get()
        // ]);

        // $posts = DB::table('posts')->find(1);
        // return view("blog.index", compact('posts'));



        // Eloquent ORM
        // $posts = Post::all();
        // $posts = Post::get();
        // $posts = Post::get()->count();
        // $posts = Post::sum('min_to_read');
        // $posts = Post::avg('min_to_read');
        // $posts = Post::orderBy('updated_at', 'desc')->get();
        // $posts = Post::orderBy('id', 'desc')->take(10)->get();
        // $posts = Post::where('min_to_read', 2)->get();
        // $posts = Post::where('min_to_read', '!=', 2)->get();
        // dd($posts);

        // return view("blog.index", ['posts' => $posts]);
        return view("blog.index", [
            'posts' => Post::orderBy('updated_at', 'desc')->paginate(20)
        ]);

        // with chunk method
        // Post::chunk(25, function ($posts) {
        //     foreach ($posts as $post) {
        //         echo $post->title . '<br>';
        //     }
        // });

        // return view("blog.index");
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blog.create");
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
            'min_to_read' => 'min:0|max:60',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->image_path = $this->storeImage($request);
        $post->is_published = $request->is_published === "on";
        $post->min_to_read = $request->min_to_read;
        $post->save();

        return redirect(route('blog.index'));
    }

    // in controller we use redirect(route('blog.index')) but in views we use just route('blog.index')

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        // $post = Post::find($id);
        // $post = Post::findOrFail($id);

        // dd($post);

        return view('blog.show', [
            'post' => Post::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        return view('blog.edit', [
            'post' => Post::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {

        // title part defines that post is unique but title can be changed with that id
        $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $id,
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['mimes:jpg,png,jpeg', 'max:5048'],
            'min_to_read' => 'min:0|max:60',
        ]);

        Post::where('id', $id)->update($request->except(['_token', '_method']));


        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect(route('blog.index'))->with('message', 'Post has been deleted!');
    }

    private function storeImage($request)
    {
        $newImageName = uniqid() . "-" . $request->title . "." . $request->image->extension();
        return $request->image->move(public_path('images'), $newImageName);
    }
}