<div class="container">
    <div class="card">
        <form action="/product/product_sub_category/{{$previd}}" method="post">
            <div class="card-header">
                <a href="/product/product_sub_category_add/{{$previd}}" class="btn btn-primary btn-lg waves-effect">新增產品次分類</a>
                <button type="submit" class="btn bgm-indigo  btn-lg waves-effect">更新排序</button>
                <a href="/product" class="btn btn-success btn-lg waves-effect">返回</a>
            </div>

            <div class="table-responsive">
                <table id="data-table-basic" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>排序</th>
                        <th>次分類名稱</th>
                        <th>檔案</th>
                        <th>選項</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($query as $row)
                        <tr>
                            <td style="cursor: move" width="10%">{{$row->order}}</td>
                            <td>{{$row->langs[0]->title}}</td>
                            <td><a target="_blank" href="/{{$row->file}}">{{$row->file_name}}</a></td>
                            <td width="15%">
                                <div class="form-group fg-line">
                                    <input type="hidden" name="order[]" class="form-control input-sm" value="{{$row->PscID}}" placeholder="排序">
                                </div>
                                <a href="/product/product_sub_category_edit/{{$row->PscID}}/{{$previd}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                <a href="/product/product_sub_category_delete/{{$row->PscID}}/{{$previd}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
                                <a href="/product/product_list/{{$row->PscID}}/{{$previd}}" class="btn bgm-deeporange "><i class="zmdi zmdi-collection-folder-image"></i></a>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/rr-1.2.3/sl-1.2.3/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#data-table-basic').dataTable({
//            "ordering": false,
            "paging": false,
            rowReorder: true,
            columnDefs: [
                {targets: [1, 2, 3], orderable: false}
            ]
        });
    });
</script>