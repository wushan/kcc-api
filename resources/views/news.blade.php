<style>
    img{
        width: 30%;
    }
</style>
<div class="container">
            <div class="card">
                <div class="card-header">
                    <a href="news/add" class="btn btn-primary btn-lg waves-effect">新增消息</a>
                </div>

                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30%">圖片</th>
                            <th>日期</th>
                            <th>展會日期</th>
                            <th>標題</th>
                            <th>摘要</th>
                            <th>內容</th>
                            <th>選項</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($news as $nrow)
                            <tr>
                                <td width="30%"><img src="{{$nrow->image}}"></td>
                                <td width="10%">{{$nrow->date}}</td>
                                <td width="10%">{{$nrow->exhibition_date}}</td>
                                <td>{{$nrow->langs[0]->title}}</td>
                                <td>{{$nrow->langs[0]->intro}}</td>
                                <td>{{$nrow->langs[0]->content}}</td>
                                <td width="12%">
                                    <a href="news/edit/{{$nrow->NewsID}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                    <a href="news/delete/{{$nrow->NewsID}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
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