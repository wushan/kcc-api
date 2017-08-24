<style>
    img{
        width: 30%;
    }
</style>
<div class="container">
            <div class="card">
                <div class="card-header">
                    <a href="/product/product_category_add" class="btn btn-primary btn-lg waves-effect">新增產品分類</a>
                </div>

                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30%">圖片</th>
                            <th>分類名稱</th>
                            <th>分類說明</th>
                            <th>檔案</th>
                            <th>選項</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($query as $row)
                            <tr>
                                <td width="30%"><img src="{{$row->image}}"></td>
                                <td>{{$row->langs[0]->title}}</td>
                                <td>{{$row->langs[0]->intro}}</td>
                                <td><a target="_blank" href="/{{$row->file}}">{{$row->file_name}}</a></td>
                                <td width="15%">
                                    <a href="/product/product_category_edit/{{$row->PcID}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                    <a href="/product/product_category_delete/{{$row->PcID}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
                                    <a href="/product/product_list/{{$row->PcID}}" class="btn bgm-deeporange "><i class="zmdi zmdi-collection-folder-image"></i></a>
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