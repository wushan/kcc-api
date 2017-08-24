<style>
    img{
        width: 30%;
    }
</style>
<div class="container">
            <div class="card">
                <div class="card-header">

                    @if ($count<5)
                        <a href="/home/home_banner_add" class="btn btn-primary btn-lg waves-effect">新增Banner</a>
                        <p class="c-black f-500">提示：最多新增5張Banner</p>
                    @endif

                </div>
                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="20%">圖片</th>
                            <th>選項</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($banner as $brow)
                            <tr>
                                <td width="20%"><img src="/{{$brow->image}}"></td>
                                <td width="8%" style="vertical-align: middle">
                                    <a href="/home/home_banner_edit/{{$brow->BannerID}}" class="btn btn-success"><i class="zmdi zmdi-edit"></i></a>
                                    <a href="/home/home_banner_delete/{{$brow->BannerID}}" onclick="return confirm('確定要刪除?');" class="btn btn-danger sa-warning"><i class="zmdi zmdi-delete"></i></a>
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