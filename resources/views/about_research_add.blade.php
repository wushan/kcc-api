<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">商品資訊</a></li>
                @foreach ($lang as $lrow)
                <li><a href="#profile{{$lrow->Id}}" aria-controls="profile{{$lrow->Id}}" role="tab" data-toggle="tab">{{$lrow->lang}}</a></li>
                @endforeach
            </ul>
            <form action="/about/about_research_add/{{$id}}" method="post" enctype="multipart/form-data">

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home11">
                    <p class="f-500 c-black m-b-20">圖片</p>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                        <div>
                  <span class="btn btn-info btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="image">
                  </span>
                            <a href="#" class="btn btn-danger fileinput-exists"
                               data-dismiss="fileinput">Remove</a>
                        </div>
                        <small>建議圖片尺寸1024 * 768  或 1600*900 </small>
                    </div>

                </div>
                @foreach ($lang as $lrow)
                <div role="tabpanel" class="tab-pane" id="profile{{$lrow->Id}}">
                    <p class="c-black f-500 m-b-20 m-t-20">標題</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line ">
                                <input type="text" class="form-control input-lg" maxlength="100" placeholder="請輸入標題"
                                       name="langs[{{$lrow->Id}}][title]" required>
                            </div>
                        </div>
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20 ">說明</p>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <textarea type="text" cols="125" rows="9" placeholder="請輸入說明"
                                      name="langs[{{$lrow->Id}}][intro]" required></textarea>

                        </div>
                    </div>
                </div>
                @endforeach
                <?php echo csrf_field(); ?>
                <button class="btn btn-primary btn-lg waves-effect">新增</button>
                <a href="/about/about_research/{{$id}}" class="btn btn-success btn-lg waves-effect">返回</a>
            </div>
            </form>

        </div>

    </div>
</div>

<script src="/css/vendors/fileinput/fileinput.min.js"></script>
