<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                {{--<li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">商品資訊</a></li>--}}
                @foreach ($lang as $lrow)
                    <li><a href="#profile{{$lrow->Id}}" aria-controls="profile{{$lrow->Id}}" role="tab" data-toggle="tab">{{$lrow->lang}}</a></li>
                @endforeach
            </ul>
            <form action="/product/product_application_edit/{{$id}}" method="post" enctype="multipart/form-data">

                <div class="tab-content">
                    {{--<div role="tabpanel" class="tab-pane active" id="home11">--}}
                        {{--<p class="f-500 c-black m-b-20">大圖片</p>--}}
                        {{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}
                            {{--<div class="fileinput-preview thumbnail" data-trigger="fileinput">--}}
                                {{--<img src="/{{$query->image}}">--}}
                            {{--</div>--}}
                            {{--<div>--}}
                  {{--<span class="btn btn-info btn-file">--}}
                      {{--<span class="fileinput-new">Select image</span>--}}
                      {{--<span class="fileinput-exists">Change</span>--}}
                      {{--<input type="file" name="image">--}}
                  {{--</span>--}}
                                {{--<a href="#" class="btn btn-danger fileinput-exists"--}}
                                   {{--data-dismiss="fileinput">Remove</a>--}}
                            {{--</div>--}}
                            {{--<small>建議圖片尺寸960 * 960</small>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                    @foreach ($lang as $k=> $lrow)
                        <input type="hidden" class="form-control input-lg" name="langs[{{$lrow->Id}}][PalID]" value="{{$query->langs[$k]->PalID or ''}}">
                        <div role="tabpanel" class="tab-pane" id="profile{{$lrow->Id}}">
                            <p class="c-black f-500 m-b-20 m-t-20">標題</p>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="fg-line ">
                                        <input type="text" class="form-control input-lg" maxlength="100" placeholder="請輸入標題"
                                               name="langs[{{$lrow->Id}}][title]" value="{{$query->langs[$k]->title or ''}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-primary btn-lg waves-effect">修改</button>
                    <a href="/product/product_application" class="btn btn-success btn-lg waves-effect">返回</a>
                </div>
            </form>

        </div>

    </div>
</div>

<script src="/css/vendors/fileinput/fileinput.min.js"></script>
<script>
    var hash = window.location.hash;
    $('ul.tab-nav li').eq(hash.substr(1)).addClass('active');
    $('.tab-pane').eq(hash.substr(1)).addClass('active');
</script>
