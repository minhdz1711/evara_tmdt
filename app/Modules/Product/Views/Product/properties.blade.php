@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.products.Attributes') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card card-default  section-attr id-984">
                                <div class="card-header">
                                    <h3 class="card-title">Sửa thuộc tính sản phẩm</h3>
                                    <input type="hidden" min="0" name="id" value="{{ $id }}"
                                           class="form-control">
                                </div>
                                <div class="card-body">
                                    @foreach($attributes as $attribute)
                                        <div class="form-group">
                                            <label for="">{{ $attribute->title }}<b>*</b></label>
                                            <select
                                                name="{{ str_replace('-','_',$attribute->slug) }}[]"
                                                id="attributes-{{ $attribute->id }}"
                                                class="form-control js-example-basic-single"
                                                multiple="multiple">
                                                @foreach(\App\Models\Config::getAttributeByID($attribute->id) as $item)
                                                    <option
                                                        value="{{ $item->id }}" {{ in_array($item->id,\App\Models\Config::getAttributeSelected($id,$attribute->id))?'selected':'' }}>{{ $item->title }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    @endforeach

                                </div>


                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    @include('admins.layouts.button-edit',['url'=>route('admin.products.index'),'display'=>''])
                                </div>
                            </div>

                        </div>
                    </div>

            </form>

        </div>
    </section>
@endsection
