<style>
    img{
        width: 30%;
    }
</style>
<div class="container">
            <div class="card">
                <div class="card-header">
                    {{--<a href="news/add" class="btn btn-primary btn-lg waves-effect">新增分類</a>--}}
                </div>

                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30%">圖片</th>
                            <th>分類名稱</th>
                            <th>選項</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($query as $row)
                            <tr>
                                <td width="30%"><img src="{{$row->image}}"></td>
                                <td>{{$row->langs[0]->title}}</td>
                                <td width="12%">
                                    <a href="/about/about_research/{{$row->ArcID}}" class="btn bgm-deeporange "><i class="zmdi zmdi-collection-folder-image"></i></a>
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