<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                @foreach ($lang as $lrow)
                    <li><a href="#profile{{$lrow->Id}}" aria-controls="profile{{$lrow->Id}}" role="tab" data-toggle="tab">{{$lrow->lang}}</a></li>
                @endforeach
            </ul>
            <form action="/product/product_sub_category_add/{{$previd}}" method="post" enctype="multipart/form-data">

                <div class="tab-content">
                    <input type="hidden" class="form-control input-lg" maxlength="30" name="date" value="{{time()}}">
                    @foreach ($lang as $k=> $lrow)
                        <div role="tabpanel" class="tab-pane" id="profile{{$lrow->Id}}">
                            <p class="c-black f-500 m-b-20 m-t-20">次分類名稱</p>
                            <div class="row">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <input type="text" class="form-control input-lg" maxlength="30" placeholder="請輸入次分類名稱" name="langs[{{$lrow->Id}}][title]" >
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
<script>
    var hash = window.location.hash;
    $('ul.tab-nav li').eq(hash.substr(1)).addClass('active');
    $('.tab-pane').eq(hash.substr(1)).addClass('active');
</script>