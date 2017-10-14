<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">次分類資訊</a></li>
                @foreach ($lang as $lrow)
                    <li><a href="#profile{{$lrow->Id}}" aria-controls="profile{{$lrow->Id}}" role="tab" data-toggle="tab">{{$lrow->lang}}</a></li>
                @endforeach
            </ul>
            <form action="/product/product_sub_category_edit/{{$query->PscID}}/{{$previd}}" method="post" enctype="multipart/form-data">

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home11">
                        <p class="c-black f-500 m-b-20 m-t-20">PDF</p>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10 waves-effect">
                                            <span class="fileinput-new">Select file</span>
                                            <input type="file" name="file">
                                        </span>
                                    <a href="/product/delete_product_sub_category_PDF/{{$query->PscID}}/{{$previd}}" class="btn btn-danger">Remove</a>
                                    <span class="fileinput-filename">{{$query->file_name}}</span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">×</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    @foreach ($lang as $k=> $lrow)
                        <input type="hidden" class="form-control input-lg" name="langs[{{$lrow->Id}}][PsclID]" value="{{$query->langs[$k]->PsclID or ''}}">
                        <div role="tabpanel" class="tab-pane" id="profile{{$lrow->Id}}">
                            <p class="c-black f-500 m-b-20 m-t-20">次分類名稱</p>
                            <div class="row">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <input type="text" class="form-control input-lg" maxlength="100" placeholder="請輸入次分類名稱" name="langs[{{$lrow->Id}}][title]" value="{{$query->langs[$k]->title or ''}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-primary btn-lg waves-effect">確定</button>
                    <a href="/product/product_sub_category/{{$previd}}" class="btn btn-success btn-lg waves-effect">返回</a>
                </div>
            </form>
        </div>

    </div>
</div>
<script src="/css/vendors/fileinput/fileinput.min.js"></script>
