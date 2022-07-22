@extends('admins.master',['title'=>$title])
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.settings.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12" style="margin-bottom: 15px !important;">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Cập nhật hệ
                            thống
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cấu hình website</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tiêu đề website</label>
                                    <input type="text" class="form-control" value="{{ @$settings['website_name'] }}"
                                           name="website_name">
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả website</label>
                                    <textarea name="website_description" class="form-control"
                                              rows="5">{{ @$settings['website_description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Tiêu đề admin</label>
                                    <input type="text" class="form-control" value="{{ @$settings['title_admin'] }}"
                                           name="title_admin">
                                </div>
                                <div class="form-group">
                                    <label for="">Copyright</label>
                                    <input type="text" class="form-control"
                                           value="{{ @$settings['website_copyright'] }}" name="website_copyright">
                                </div>
                            </div>
                        </div><!--setting-->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin liên hệ</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="form-control" value="{{ @$settings['website_phone'] }}"
                                           name="website_phone">
                                </div>
                                <div class="form-group">
                                    <label for="">Hotline</label>
                                    <input type="text" class="form-control" value="{{ @$settings['website_hotline'] }}"
                                           name="website_hotline">
                                </div>
                                <div class="form-group">
                                    <label for="">Fax</label>
                                    <input type="text" class="form-control" value="{{ @$settings['website_fax'] }}"
                                           name="website_fax">
                                </div>
                                <div class="form-group">
                                    <label for="">Quốc gia</label>
                                    <input type="text" class="form-control" value="{{ @$settings['company_city'] }}"
                                           name="company_city">
                                </div>
                                <div class="form-group">
                                    <label for="">Tỉnh thành</label>
                                    <input type="text" class="form-control" value="{{ @$settings['company_district'] }}"
                                           name="company_district">
                                </div>
                                <div class="form-group">
                                    <label for="">Địa chỉ</label>
                                    <input type="text" class="form-control" value="{{ @$settings['website_address'] }}"
                                           name="website_address">
                                </div>
                                <div class="form-group">
                                    <label for="">Mã Zip</label>
                                    <input type="text" class="form-control"
                                           value="{{ @$settings['company_postal_code'] }}" name="company_postal_code">
                                </div>
                                <div class="form-group">
                                    <label for="">Bản đồ</label>
                                    <textarea name="company_lat" class="form-control"
                                              rows="5">{{ @$settings['company_lat'] }}</textarea>
                                </div>
                            </div>
                        </div><!--contact-->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tiêu đề</label>
                                    <input type="text" class="form-control" value="{{ @$settings['seo_title'] }}"
                                           name="seo_title">
                                </div>
                                <div class="form-group">
                                    <label for="">Từ khoá</label>
                                    <input type="text" class="form-control" value="{{ @$settings['seo_keyword'] }}"
                                           name="seo_keyword">
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <textarea name="seo_description" class="form-control"
                                              rows="5">{{ @$settings['seo_description'] }}</textarea>
                                </div>
                            </div>
                        </div><!--seo-->


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cài đặt thời gian</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Kiểu thời gian mặc định</label>
                                    <select name="format_datetime" class="form-control">
                                        <option value="d/m/Y H:i"
                                                @if(@$settings['format_datetime']=="d/m/Y H:i") selected @endif>{{ date('d/m/Y H:i') }}</option>
                                        <option value="d/m/Y H:i:s"
                                                @if(@$settings['format_datetime']=="d/m/Y H:i:s") selected @endif>{{ date('d/m/Y H:i:s') }}</option>
                                        <option value="Y-m-d H:i"
                                                @if(@$settings['format_datetime']=="Y-m-d H:i") selected @endif>{{ date('Y-m-d H:i') }}</option>
                                        <option value="Y-m-d H:i"
                                                @if(@$settings['format_datetime']=="Y-m-d H:i") selected @endif>{{ date('Y-m-d H:i:s') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kiểu ngày tháng mặc định</label>
                                    <select name="format_date" class="form-control">
                                        <option value="d/m/Y"
                                                @if(@$settings['format_date']=="d/m/Y") selected @endif>{{ date('d/m/Y') }}</option>
                                        <option value="d/m/Y"
                                                @if(@$settings['format_date']=="m/d/Y") selected @endif>{{ date('m/d/Y') }}</option>
                                        <option value="Y-m-d"
                                                @if(@$settings['format_date']=="Y-m-d") selected @endif>{{ date('Y-m-d') }}</option>
                                        <option value="j F, Y"
                                                @if(@$settings['format_date']=="j F, Y") selected @endif>{{ date('j F, Y') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kiểu ngày tháng mặc định</label>
                                    <select name="format_time" class="form-control">
                                        <option value="g:i a"
                                                @if(@$settings['format_time']=="g:i a") selected @endif>{{ date('g:i a') }}</option>
                                        <option value="g:i A"
                                                @if(@$settings['format_time']=="g:i A") selected @endif>{{ date('g:i A') }}</option>
                                        <option value="H:i"
                                                @if(@$settings['format_time']=="H:i") selected @endif>{{ date('H:i') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div><!--time-zone-->
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Logo & Favicon</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label for="">Logo</label>
                                            <div class="previewThumbnail">
                                                @if(@$settings['website_logo']!="")
                                                    <img id="website_logo" class="imgPreview"
                                                         src="{{ (@$settings['website_logo']!="")?url(@$settings['website_logo']):URL::asset('images/no_picture.gif') }}"/>
                                                @else
                                                    <img id="website_logo" class="imgPreview"
                                                         src="{{ (old('website_logo')!="")?old('website_logo'):URL::asset('images/no_picture.gif') }}"/>
                                                @endif
                                                <input type="hidden" name="website_logo" id="view_logo"
                                                       class="inputImg"
                                                       value="{{ (@$settings['website_logo']!="")?@$settings['website_logo']:'' }}"/>
                                                <a href="javascript:void(0)"
                                                   onclick="selectFileWithCKFinder('view_logo', 'website_logo')">Thêm
                                                    logo</a>
                                                <a href="javascript:void(0);"
                                                   class="btn btn-outline-danger btn-sm btn-close"
                                                   onclick="removeFileWithCKFinder('view_logo', 'website_logo')"><i
                                                            class="fa fa-close"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label for="">Favicon</label>
                                            <div class="previewThumbnail">
                                                @if(@$settings['website_favicon']!="")
                                                    <img id="website_favicon" class="imgPreview"
                                                         src="{{ (@$settings['website_favicon']!="")?url(@$settings['website_favicon']):URL::asset('images/no_picture.gif') }}"/>
                                                @else
                                                    <img id="website_favicon" class="imgPreview"
                                                         src="{{ (old('website_favicon')!="")?old('website_favicon'):URL::asset('images/no_picture.gif') }}"/>
                                                @endif
                                                <input type="hidden" name="website_favicon" id="view_favicon"
                                                       class="inputImg"
                                                       value="{{ (@$settings['website_favicon']!="")?@$settings['website_favicon']:'' }}"/>
                                                <a href="javascript:void(0)"
                                                   onclick="selectFileWithCKFinder('view_favicon', 'website_favicon')">Thêm
                                                    favicon</a>
                                                <a href="javascript:void(0);"
                                                   class="btn btn-outline-danger btn-sm btn-close"
                                                   onclick="removeFileWithCKFinder('view_favicon', 'website_favicon')"><i
                                                            class="fa fa-close"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--logo-->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Social</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Facebook</label>
                                    <input type="text" class="form-control" value="{{ @$settings['_social_facebook'] }}"
                                           name="_social_facebook">
                                </div>
                                <div class="form-group">
                                    <label for="">Youtube</label>
                                    <input type="text" class="form-control" value="{{ @$settings['_social_youtube'] }}"
                                           name="_social_youtube">
                                </div>
                                <div class="form-group">
                                    <label for="">Twitter</label>
                                    <input type="text" class="form-control" value="{{ @$settings['_social_twitter'] }}"
                                           name="_social_twitter">
                                </div>
                                <div class="form-group">
                                    <label for="">Instagram</label>
                                    <input type="text" class="form-control"
                                           value="{{ @$settings['_social_instagram'] }}" name="_social_instagram">
                                </div>
                                <div class="form-group">
                                    <label for="">Skype</label>
                                    <input type="text" class="form-control" value="{{ @$settings['_social_skype'] }}"
                                           name="_social_skype">
                                </div>
                                <div class="form-group">
                                    <label for="">Google</label>
                                    <input type="text" class="form-control"
                                           value="{{ @$settings['_social_google_plus'] }}" name="_social_google_plus">
                                </div>
                                <div class="form-group">
                                    <label for="">Fanpage</label>
                                    <textarea name="website_fanpage" class="form-control"
                                              rows="5">{{ @$settings['website_fanpage'] }}</textarea>
                                </div>
                            </div>
                        </div><!--social-->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Custom Website</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Chèn Head</label>
                                    <textarea name="website_header" class="form-control"
                                              rows="5">{{ @$settings['website_header'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Chèn Body</label>
                                    <textarea name="website_header" class="form-control"
                                              rows="5">{{ @$settings['website_body'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Chèn Footer</label>
                                    <textarea name="website_header" class="form-control"
                                              rows="5">{{ @$settings['website_footer'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Custom Css</label>
                                    <textarea name="website_header" class="form-control"
                                              rows="5">{{ @$settings['website_css'] }}</textarea>
                                </div>
                            </div>
                        </div><!--script-->
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
