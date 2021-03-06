<style>
    img{
        width: 30%;
    }
</style>
<div class="container">
            <form action="/product/product_application_product/{{$id}}" method="post">
    <div class="card">
                <div class="card-header">
                    <a href="/product/product_application" class="btn btn-success btn-lg waves-effect">返回</a>
                    <button type="submit" class="btn bgm-indigo  btn-lg waves-effect">更新排序</button>
                    @if ($count<6)
                    <a href="/product/product_application_product_add/{{$id}}" class="btn btn-primary btn-lg waves-effect">新增商品</a>
                    @endif
                    <span class="c-black f-500">提示：最多新增6項商品</span>
                </div>
                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>排序</th>
                            <th width="30%">圖片</th>
                            <th>標題</th>
                            <th>說明</th>
                            <th>選項</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($applicationProduct as $row)
                            <tr>
                                <td style="cursor: move" width="10%">
                                    {{$row->order}}
                                </td>
                                <td width="30%">
                                    <img src="/{{$row->image}}">
                                    <div class="form-group fg-line">
                                        <input type="hidden" name="order[]" class="form-control input-sm" value="{{$row->PapID}}" placeholder="排序">
                                    </div>
                                </td>
                                <td>{{$row->langs[0]->title}}</td>
                                <td>{{$row->langs[0]->intro}}</td>
                                <td width="12%">
                                    <a href="/product/product_application_product_edit/{{$row->PapID}}/{{$id}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                    <a href="/product/product_application_product_delete/{{$row->PapID}}/{{$id}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <?php echo csrf_field(); ?>
            </form>
        </div>
{{--<script src="/css/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/rr-1.2.3/sl-1.2.3/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table-basic').dataTable( {
//            "ordering": false,
            "lengthChange":false,
            "searching":false,
            "paging": false,
            rowReorder: true,
            columnDefs: [
                {targets: [1, 2, 3, 4], orderable: false}
            ]
        } );
    } );
</script>