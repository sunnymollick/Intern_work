<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function storeUser(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();
        return response()->json([
            'user' => $user ,
        ]);
    }

    public function index($search){
        $user = User::findOrFail(1);
        echo($user->address->city);
        // dd($user->address->state);
        $address = Address::find(2);
        echo($address->user->name.'</br>');
        foreach ($user->posts as $value) {
            echo $value->title.'</br>';
        }
        $post = Post::find(1);
        foreach ($post->tags as $value) {
            echo $value->title.'</br>';
        }

        $tag = Tag::find(2);
        foreach ($tag->posts as $value) {
            echo $value->description.'</br>';
        }

        $post = Post::find(1);
        $post->tags()->attach([3,4]);
        $post->tags()->detach();
        $post->tags()->sync([3,4,5]);

        $post = Post::where('title','like','%'.$search.'%')
                        ->orWhere('author_name','like','%'.$search.'%')
                        ->orWhere('description','like','%'.$search.'%')
                        ->get();

        // $post = EloquentBuilder::to(User::class,$request->all())->get();

    }
}
