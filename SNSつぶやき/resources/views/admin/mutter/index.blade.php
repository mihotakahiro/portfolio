@extends('layouts.admin')
@section('title', 'ホーム')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-8 mx-auto">
       
               <div class="card">
                   <div class="card-body">  
                       <p>ホーム</p>
                   </div>
               </div>

               <form action="{{ url('admin/mutter_store') }}" method="post" enctype="multipart/form-data">
                   @if (count($errors) > 0)
                       <ul>
                           @foreach($errors->all() as $e)
                               <li>{{ $e }}</li>
                           @endforeach
                       </ul>
                   @endif

                   <div class="card">
                       <div class="card-body">       
                            <div class="mb-3">
                                <textarea required class="form-control" name="body" rows="1" id="body"
                                placeholder="いまどうしてる?" maxlength="255">{{ old('body') }}</textarea>
                            </div>

                            {{ csrf_field() }}
                            <div class="text-end">
                            <button type="submit" class= "border-0 btn-secondary mt-2 text-center px-3 py-2">つぶやく</button>
                            </div>
                       </div>
                   </div>
               </form>
               <br> 



                @foreach($posts as $post)

                    <div class="card">
                        <div class="card-body"> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 68%"></th>
                                        <th scope="col" style="width: 32%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>{{ $post->user->name }}</b></td>
                                        <td>{{$post->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$post->body}}</td>
                                        @if($login_user_id == $post->user->id) 

                                            <td><form class="delete" method="post" action="{{ route('delete', $post) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="submit" value="削除">
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>    
                        </div>
                    </div>
                @endforeach
            </div>        
        </div>
   </div>
@endsection










