<style>
    img{
        width: 30%;
    }
</style>
<div class="container">
            <div class="card">
                <div class="card-header">
                    <a href="/about/about_research_category" class="btn btn-success btn-lg waves-effect">返回</a>
                    <a href="/about/about_research_add/{{$id}}" class="btn btn-primary btn-lg waves-effect">新增商品</a>
                </div>
                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30%">圖片</th>
                            <th>標題</th>
                            <th>選項</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($query as $row)
                            <tr>
                                <td width="30%"><img src="/{{$row->image}}"></td>
                                <td>{{$row->langs[0]->title}}</td>
                                <td width="12%">
                                    <a href="/about/about_research_edit/{{$row->ArID}}/{{$id}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                    <a href="/about/about_research_delete/{{$row->ArID}}/{{$id}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
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
            "ordering": false,
            "lengthChange":false,
            "searching":false
        } );
    } );
</script>