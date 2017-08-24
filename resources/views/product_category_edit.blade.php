<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">分類資訊</a></li>
                @foreach ($lang as $lrow)
                <li><a href="#profile{{$lrow->Id}}" aria-controls="profile{{$lrow->Id}}" role="tab" data-toggle="tab">{{$lrow->lang}}</a></li>
                @endforeach
            </ul>
            <form action="/product/product_category_edit/{{$query->PcID}}" method="post" enctype="multipart/form-data">

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home11">
                    <p class="f-500 c-black m-b-20">圖片</p>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                            <img src="/{{$query->image}}">
                        </div>
                        <div>
                  <span class="btn btn-info btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="image">
                  </span>
                            <a href="#" class="btn btn-danger fileinput-exists"
                               data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20">PDF</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10 waves-effect">
                                            <span class="fileinput-new">Select file</span>
                                            <input type="file" name="file">
                                        </span>
                                <span class="fileinput-filename">{{$query->file_name}}</span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput">×</a>
                            </div>
                        </div>
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20">額外介紹區塊選擇</p>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" id="typ-0" name="type" value="0" {{$query->type==0?"checked":""}}>
                                <i class="input-helper"></i>
                                無
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" id="typ-1" name="type" value="1" {{$query->type==1?"checked":"" }}>
                                <i class="input-helper"></i>
                                圖片區塊(左右兩張圖)
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" id="typ-2" name="type" value="2" {{$query->type==2?"checked":""}}>
                                <i class="input-helper"></i>
                                圖文區塊
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" id="typ-3" name="type" value="3" {{$query->type==3?"checked":""}}>
                                <i class="input-helper"></i>
                                文字區塊
                            </label>
                        </div>
                    </div>

                </div>
                @foreach ($lang as $k=>$lrow)
                <div role="tabpanel" class="tab-pane" id="profile{{$lrow->Id}}">
                    <input type="hidden" name="langs[{{$lrow->Id}}][PclID]" value="{{$query->langs[$k]->PclID}}">
                    <p class="c-black f-500 m-b-20 m-t-20">分類名稱</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line ">
                                <input type="text" class="form-control input-lg" maxlength="30" placeholder="請輸入分類名稱"
                                       name="langs[{{$lrow->Id}}][title]" value="{{$query->langs[$k]->title}}" required>
                            </div>
                        </div>
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20">分類說明</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line ">
                                <input type="text" class="form-control input-lg" maxlength="50" placeholder="請輸入分類說明"
                                       name="langs[{{$lrow->Id}}][intro]" value="{{$query->langs[$k]->title}}" required>
                            </div>
                        </div>
                    </div>
                    <?php $extra=json_decode($query->langs[$k]->extra_intro)?>
                    <p class="c-black f-500 m-b-20 m-t-20 typ-1">額外介紹</p>
                    <div class="row typ-1">
                        <div class="form-group col-sm-12">
                            <p class="f-500 c-black m-b-20">圖片區塊</p>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                    <img src="/{{($query->type==1 && $extra)?$extra->image[0] :''}}">
                                </div>
                                <div>
                                 <span class="btn btn-info btn-file">
                                     <span class="fileinput-new">Select image</span>
                                     <span class="fileinput-exists">Change</span>
                                     <input class="typ-1" type="file" name="langs[{{$lrow->Id}}][extra_intro][Limage]" disabled >
                                 </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                    <img src="/{{($query->type==1 && $extra)?$extra->image[1] :''}}">
                                </div>
                                <div>
                                 <span class="btn btn-info btn-file">
                                     <span class="fileinput-new">Select image</span>
                                     <span class="fileinput-exists">Change</span>
                                     <input class="typ-1" type="file" name="langs[{{$lrow->Id}}][extra_intro][Rimage]" disabled >
                                 </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20 typ-2">圖文區塊</p>
                    <div class="row typ-2">
                        <div class="form-group col-sm-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                    <img src="/{{($query->type==2)?$extra->image :''}}">
                                </div>
                                <div>
                                 <span class="btn btn-info btn-file">
                                     <span class="fileinput-new">Select image</span>
                                     <span class="fileinput-exists">Change</span>
                                     <input class="typ-2" type="file" name="langs[{{$lrow->Id}}][extra_intro][image]" disabled >
                                 </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <textarea type="text" class="typ-2" cols="80" rows="9" placeholder="請輸入文字"
                                          name="langs[{{$lrow->Id}}][extra_intro][content]" disabled required>{{$extra->content or ''}}</textarea>

                        </div>
                    </div>
                    <p class="c-black f-500 m-b-20 m-t-20 typ-3">文字區塊</p>
                    <div class="row typ-3">
                        <div class="form-group col-sm-12">
                            <textarea type="text" class="typ-3" cols="125" rows="9" placeholder="請輸入文字"
                                      name="langs[{{$lrow->Id}}][extra_intro][content]" disabled required>{{$extra->content or ''}}</textarea>

                        </div>
                    </div>

                </div>
                @endforeach
                <?php echo csrf_field(); ?>
                <button class="btn btn-primary btn-lg waves-effect">修改</button>
                <a href="/product" class="btn btn-success btn-lg waves-effect">返回</a>
            </div>
            </form>

        </div>

    </div>
</div>

<script src="/css/vendors/fileinput/fileinput.min.js"></script>
<script>
    $(function () {
        var type='{{$query->type}}';
        for (i=1;i<=3;i++){
            $('.typ-'+i).hide();
            $('.typ-'+i).attr('disabled',true);
        }

        $('#typ-0').click(function () {
            for (i=1;i<=3;i++){
                $('.typ-'+i).hide();
                $('.typ-'+i).attr('disabled',true);
            }
        });
        $('#typ-1').click(function () {
            $('.typ-1').show();
            $('.typ-1').attr('disabled',false);
            $('.typ-2,.typ-3').hide();
            $('.typ-2,.typ-3').attr('disabled',true);

        });
        $('#typ-2').click(function () {
            $('.typ-2').show();
            $('.typ-2').attr('disabled',false);
            $('.typ-1,.typ-3').hide();
            $('.typ-1,.typ-3').attr('disabled',true);

        });
        $('#typ-3').click(function () {
            $('.typ-3').show();
            $('.typ-3').attr('disabled',false);
            $('.typ-1,.typ-2').hide();
            $('.typ-1,.typ-2').attr('disabled',true);

        });
        switch(type)
        {
            case '0':
                $('#typ-0').trigger('click');
                break;
            case '1':
                $('#typ-1').trigger('click');
                break;
            case '2':
                $('#typ-2').trigger('click');
                break;
            case '3':
                $('#typ-3').trigger('click');
                break;
        }
    })

</script>