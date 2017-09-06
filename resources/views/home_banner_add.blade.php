<div class="card">
    <div class="card-body card-padding">
        <div role="tabpanel">
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">新增Banner</a></li>
            </ul>
            <form action="/home/home_banner_add" method="post" enctype="multipart/form-data">

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home11">
                    <p class="f-500 c-black m-b-20">圖片</p>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                        <div>
                  <span class="btn btn-info btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="image" required>
                  </span>
                            <a href="#" class="btn btn-danger fileinput-exists"
                               data-dismiss="fileinput">Remove</a>
                        </div>
                        <small>建議圖片尺寸1600 * 900</small>
                    </div>
                </div>
                <?php echo csrf_field(); ?>
                <button class="btn btn-primary btn-lg waves-effect">新增</button>
                <a href="/home/home_banner" class="btn btn-success btn-lg waves-effect">返回</a>
            </div>
            </form>

        </div>

    </div>
</div>

<script src="/css/vendors/fileinput/fileinput.min.js"></script>
