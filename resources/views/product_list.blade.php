<style>
    img {
        width: 30%;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="/product/product_sub_category/{{$previd}}" class="btn btn-success btn-lg waves-effect">返回</a>
        </div>
        <div class="card-header">
            <small>建議圖片尺寸960 * 960 ( 正方形透明圖 )</small>
            <form class="dropzone dz-clickable" id="dropzone-upload">
                <?php echo csrf_field(); ?>
                <div class="dz-default dz-message">
                    <span>上傳圖片(可拖曳上傳)</span>
                </div>
            </form>
        </div>
        <form action="/product/product_list/{{$subid}}/{{$previd}}" method="post">
            <div class="card-header">
                <button type="submit" class="btn bgm-indigo  btn-lg waves-effect">更新排序</button>
            </div>
            <div class="table-responsive">
                <table id="data-table-basic" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>排序</th>
                        <th width="20%">圖片</th>
                        <th>標題</th>
                        <th>說明</th>
                        <th>選項</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($query as $row)
                        <tr>
                            <td style="cursor: move" width="10%">{{$row->order}}</td>
                            <td width="30%">
                                <img src="/{{$row->image}}">
                                <div class="form-group fg-line">
                                    <input type="hidden" name="order[]" class="form-control input-sm" value="{{$row->PdID}}" placeholder="排序">
                                </div>
                            </td>
                            <td style="vertical-align: middle">{{$row->langs[0]->title}}</td>
                            <td style="vertical-align: middle">{{$row->langs[0]->intro}}</td>
                            <td width="15%" style="vertical-align: middle">

                                <a href="/product/product_edit/{{$row->PdID}}/{{$subid}}/{{$previd}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                <a href="/product/product_delete/{{$row->PdID}}/{{$subid}}/{{$previd}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <?php echo csrf_field(); ?>
        </form>
    </div>
</div>
{{--<script src="/css/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>--}}
<script src="/css/vendors/bower_components/dropzone/dist/min/dropzone.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/rr-1.2.3/sl-1.2.3/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#data-table-basic').dataTable({
//            "ordering": false,
            "lengthChange": false,
            "searching": false,
            "paging": false,
            rowReorder: true,
            columnDefs: [
                {targets: [1, 2, 3, 4], orderable: false}
            ]
        });
        $("#dropzone-upload").dropzone({
            url: "/product/product_list/{{$subid}}/{{$previd}}",
            acceptedFiles: 'image/*',
            paramName: "image",
            init: function () {
                this.on("success", function () {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        location.reload()
                    }
                });
            }
        });
    });
</script>