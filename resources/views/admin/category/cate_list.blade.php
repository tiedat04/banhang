@extends('admin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh Mục
                    <small>Danh Sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Danh Mục</th>
                        <th>Trạng Thái</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cates as $cate)
                    <tr class="{{ $loop->odd ? 'odd gradeX' : 'even gradeC' }}" align="center">
                        <td>{{ $cate->id }}</td>
                        <td>{{ $cate->name }}</td>
                        <td>{{ $cate->parent ? $cate->parent->name : 'Không' }}</td>
                        <td>{{ $cate->status ? 'Hiện' : 'Ẩn' }}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('categories.destroy', $cate->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $cate->id }}').submit();"> Xóa</a></td>
                        <form id="delete-form-{{ $cate->id }}" action="{{ route('categories.destroy', $cate->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('categories.edit', $cate->id) }}">Sửa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});
</script>
@endsection
