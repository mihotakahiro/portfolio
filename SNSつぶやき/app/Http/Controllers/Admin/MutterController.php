<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mutter;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class MutterController extends Controller
{

    public function index()
    {
      $posts = Mutter::all();

      $posts ->load('user');

      $posts = $posts->sortBy([
        ['updated_at', 'desc'],
        ['created_at', 'desc'],
      ]);

      $login_user_id = Auth::id();



      return view('admin.mutter.index',compact('posts','login_user_id'));

    }

    public function store(Request $request) {
   
      $posts = new Mutter();

      $posts->user_id = Auth::id();
      $posts->body = $request->body;
      $posts->save();
      
      return redirect(route('index'));
  }

  public function destroy($id) {

      $post = Mutter::find($id);
      $post->delete();
      return redirect()->route('index');
  }

}

