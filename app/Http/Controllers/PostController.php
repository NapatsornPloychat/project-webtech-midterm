<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(50);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:5', 'max:1000'],
            'contact' => ['required', 'min:5', 'max:255'],
            'image' => 'required'
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->contact = $request->input('contact');
        $post->agency = $request->input('tags');
        if($request->hasFile('image')){
            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extention;
            $file->move('public/images/',$fileName);
            $post->image=$fileName;
        }
        if (!empty($request->input('anonymous'))) {
            $anonymous = $request->input('anonymous');
            $post->anonymous = $anonymous;
        }
//        }else{
//            $post->anonymous = 0;
//        }
//        $path = $request->image->store('image');
////        return public/images/filename
////        dd($path);
//        $path = str_replace("public","storage", $path);
////        return storage/images/filename
//
//        $post->image = $path;

        $post->vote_count = 0;
        $post->user_id = $request->user()->id;
        $post->save();
        $tags = $request->get('tags');
        $tag_ids = $this->syncTags($tags);
        $post->tags()->sync($tag_ids);

        return redirect()->route('posts.show', [ 'post' => $post->id ]);
        //                     --------------------------^
        //                    |
        // GET|HEAD  posts/{post} ........ posts.show › PostController@show
    }

    private function syncTags($tags)
    {
        $tags = explode(",", $tags);
        $tags = array_map(function ($v) {
            return Str::ucfirst(trim($v));
        }, $tags);

        $tag_ids = [];
        foreach ($tags as $tag_name) {
            $tag = Tag::where('name', $tag_name)->first();
            if (!$tag) {
                $tag = new Tag();
                $tag->name = $tag_name;
                $tag->save();
            }
            $tag_ids[] = $tag->id;
        }
        return $tag_ids;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)       // dependency injection
    {
//        if (is_int($post->view_count)) {
//            $post->view_count = $post->view_count + 1;
//            $post->save();
//        }
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $tags = $post->tags->pluck('name')->all();
        $tags = implode(", ", $tags);
        return view('posts.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:5', 'max:1000'],
            'contact' => ['required', 'min:5', 'max:255'],

        ]);

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->contact = $request->input('contact');
        if($request->input('tags')!==null) {
            $post->agency = $request->input('tags');
        }

        if($request->input('status')!==null){
            $post->status = $request->input('status');
        }
        if($request->hasFile('image')){
            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extention;
            $file->move('public/images/',$fileName);
            $post->image=$fileName;
        }

        $post->save();



        $tags = $request->get('tags');
        $tag_ids = $this->syncTags($tags);
        $post->tags()->sync($tag_ids);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

//    public function updateStatus(Request $request,Post $post){
//        $this->authorize('updateStatus',$post);
//        $post->status=$request->input('status');
//        $post->save();
//        return redirect()->route('posts.show',['post'=>$post->id]);
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('delete', $post);

        $title = $request->input('title');
        if ($title == $post->title) {
            $post->delete();
            return redirect()->route('posts.index');
        }

        return redirect()->back();
    }

    public function storeComment(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->message = $request->get('message');
        $post->comments()->save($comment);
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function postTracker(){
        $posts = Post::where('user_id', Auth::user()->id)->get();

        return view('posts.tracker',['posts'=>$posts]);
    }

    public function votePost(Post $post)
    {
//        $user_id = Auth::user()->id;
//        $post = Post::find($id);
//        $like = DB::table('likeable_likes')->where('user_id',str($user_id))
//            ->where('likeable_id',$id)->first();
//        if ($like != null){
//            $post->unlike();
//        }
//        else{
//            $post->like();
//        }
//        $post->view_count += 1;
//        $post->save();

        if (is_int($post->vote_count)) {
            $post->vote_count = $post->vote_count + 1;
            $post->save();
        }
        return redirect()->route('posts.show', ['post' => $post]);
    }
}
