<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">消息資訊</a></li>
                @foreach ($lang as $lrow)
                <li><a href="#profile{{$lrow->Id}}" aria-controls="profile{{$lrow->Id}}" role="tab" data-toggle="tab">{{$lrow->lang}}</a></li>
                @endforeach
            </ul>
            <form action="/news/insert" method="post" enctype="multipart/form-data">

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
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20">日期</p>
                    <div class="row">
                        <div class="input-group form-group col-sm-4">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                            <div class="dtp-container">
                                <input type='text' class="form-control date-picker " data-date-format="YYYY-MM-DD"
                                       placeholder="選擇日期" name="date" required>
                            </div>
                        </div>
                    </div>

                </div>
                @foreach ($lang as $lrow)
                <div role="tabpanel" class="tab-pane" id="profile{{$lrow->Id}}">
                    <p class="c-black f-500 m-b-20 m-t-20">標題</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line ">
                                <input type="text" class="form-control input-lg" maxlength="30" placeholder="請輸入標題"
                                       name="langs[{{$lrow->Id}}][title]" required>
                            </div>
                        </div>
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20">摘要</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line ">
                                <input type="text" class="form-control input-lg" maxlength="200" placeholder="請輸入摘要"
                                       name="langs[{{$lrow->Id}}][intro]" required>
                            </div>
                        </div>
                    </div>
                    <p class="c-black f-500 m-b-20 m-t-20">內容</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line ">
                                <textarea placeholder="請輸入摘要" rows="10" cols="60" name="langs[{{$lrow->Id}}][content]" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <?php echo csrf_field(); ?>
                <button class="btn btn-primary btn-lg waves-effect">新增</button>
                <a href="/news" class="btn btn-success btn-lg waves-effect">返回</a>
            </div>
            </form>

        </div>

    </div>
</div>

<script src="/css/vendors/fileinput/fileinput.min.js"></script>
