@extends('voyager::master')
@section('content')
  
  <div class="container" style="margin-top: 10%">
    <p>Имортироуйте товары из excel файла!</p>
    <form action="/admin/excel-import/send" method="post">
      @csrf
      <button type="submit" class="btn btn-primary save">Save</button>
    </form>
  </div> 

@stop