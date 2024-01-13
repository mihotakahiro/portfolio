@extends('layouts.admin')
@section('title', 'ホーム')


@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-8 mx-auto">
               <h2>ホーム</h2>
               <!-- form action修正 -->
               <form action="{{ url('admin/mutter/update') }}" method="post" enctype="multipart/form-data">
                   @if (count($errors) > 0)
                       <ul>
                           @foreach($errors->all() as $e)
                               <li>{{ $e }}</li>
                           @endforeach
                       </ul>
                   @endif
                   <div class="mb-3">
                       <input type="text" name="title" class="form-control" id="title" value="{{ $mutter_form->title }}">
                   </div>
                   <div class="mb-3">
                       <label for="body" class="form-label">本文</label>
                       <textarea class="form-control" name="body" rows="20" id="body">{{ $mutter_form->body }}</textarea>
                   </div>
                   <div class="mb-3">
                       <label class="col-md-2" for="file">画像</label>
                       <input type="file" class="form-control" name="image" id="file">
                   </div>
                   {{ csrf_field() }}
                   <div class="text-center">
                       <input type="hidden" name="id" value="{{ $mutter_form->id }}">
                       <button type="submit" class="btn btn-primary mt-2 text-center px-5 py-2">更新</button>
                   </div>
               </form>
               <div class="row mt-5">
                   <h2>編集履歴</h2>
                   <table class="table table-light">
                       <thead>
                           <tr>
                               <th width="10%">ID</th>
                               <th width="30%">更新日</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($mutter_form->histories as $history)
                               <tr>
                                   <th>{{ $history->id }}</th>
                                   <td>{{ $history->edited_at }}</td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
@endsection