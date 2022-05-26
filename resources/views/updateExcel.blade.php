@extends('voyager::master')
@section('content')

    <div class="container" style="margin-top: 10%">
        <h3>Имортируйте товары из excel файла!</h3>
        <form action="/admin/excel-import-update/send" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" style="margin-top: 15px">
            <button type="submit" class="btn btn-primary save" style="margin-top: 15px">Импортировать</button>
        </form>
    </div>

@stop
