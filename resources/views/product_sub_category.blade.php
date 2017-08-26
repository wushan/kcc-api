<div class="container">
            <div class="card">
                <div class="card-header">
                    <a href="/product/product_sub_category_add/{{$previd}}" class="btn btn-primary btn-lg waves-effect">新增產品次分類</a>
                    <a href="/product" class="btn btn-success btn-lg waves-effect">返回</a>
                </div>

                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>次分類名稱</th>
                            <th>選項</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($query as $row)
                            <tr>
                                <td>{{$row->langs[0]->title}}</td>
                                <td width="15%">
                                    <a href="/product/product_sub_category_edit/{{$row->PscID}}/{{$previd}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                    <a href="/product/product_sub_category_delete/{{$row->PscID}}/{{$previd}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
                                    <a href="/product/product_list/{{$row->PscID}}/{{$previd}}" class="btn bgm-deeporange "><i class="zmdi zmdi-collection-folder-image"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<script src="/css/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table-basic').dataTable( {
            "ordering": false
        } );
    } );
</script>