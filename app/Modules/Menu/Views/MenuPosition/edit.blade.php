@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.menu-positions.update',$position->id) }}" method="POST">
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
                                    <label for="">Tên vị trí <b>*</b></label>
                                    <input type="text" name="title" value="{{ $position->title  }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @include('admins.layouts.button-edit',['url'=>route('admin.menu-positions.index'),'display'=>''])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
