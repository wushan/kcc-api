<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                @foreach ($lang as $lrow)
                    <li><a href="#profile{{$lrow->Id}}" aria-controls="profile{{$lrow->Id}}" role="tab" data-toggle="tab">{{$lrow->lang}}</a></li>
                @endforeach
            </ul>
            <form action="/product/product_star_edit/{{$star->PstarID}}" method="post" enctype="multipart/form-data">

                <div class="tab-content">
                    <input type="hidden" class="form-control input-lg" maxlength="30" name="item" value="news">
                    @foreach ($lang as $k=> $lrow)
                        <input type="hidden" class="form-control input-lg" name="langs[{{$lrow->Id}}][PstarlangID]"  value="{{$star->langs[$k]->PstarlangID or ''}}">

                        <div role="tabpanel" class="tab-pane" id="profile{{$lrow->Id}}">

                            <p class="c-black f-500 m-b-20 m-t-20">說明</p>
                            <div class="row">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <input type="text" class="form-control input-lg" maxlength="50" placeholder="請輸入說明" name="langs[{{$lrow->Id}}][intro]" value="{{$star->langs[$k]->intro or ''}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-primary btn-lg waves-effect">確定</button>
                    <a href="/product/product_star" class="btn btn-success btn-lg waves-effect">返回</a>
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