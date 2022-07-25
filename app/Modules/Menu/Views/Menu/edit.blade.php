@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.menus.update',$menu->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên menu <b>*</b></label>
                                    <input type="text" name="title" value="{{ $menu->title  }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Vị trí menu <b>*</b></label>
                                    <select name="id_position" class="form-control">
                                        @foreach($positions as $position)
                                            <option
                                                value="{{ $position->id }}" @if($position->id==$menu->id_position) selected @endif>{{ $position->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @include('admins.layouts.button-edit',['url'=>route('admin.menus.index'),'display'=>''])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
