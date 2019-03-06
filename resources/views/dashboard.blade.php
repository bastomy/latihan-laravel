@extends('master')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
@endsection
@section('content')
	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @if (count($courses)>0)
           	@foreach ($courses as $key => $value)
           		<tr>
           			<td>{{ $key+1 }}</td>
           			<td>{{ $value->name }}</td>
           			<td>{{ $value->desc }}</td>
           			<td>
           				<button class="btn btn-warning btn-sm" onclick="edit({{ $value->id }})">Edit</button>
           				<a href="{{ route('delete',$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
           			</td>
           		</tr>
           	@endforeach
           @endif
        </tbody>
    </table>
          <!-- Modal -->
      <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <form action="{{ route('edit') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id_course">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Course</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" id="name" required="required" class="form-control" placeholder="Course name">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" id="desc" placeholder="Description"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </div>
          </form>
        </div>
      </div>
@endsection
@section('js')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$('#example').DataTable( {
	    autoFill: true
	} );

	function edit(id) {
		$.post("{{ route('get') }}",{
            "_token": "{{ csrf_token() }}",
            id : id
		},function(data){
			$("#id_course").val(data.id);
			$("#name").val(data.name);
			$("#desc").val(data.desc);
			$("#editModal").modal('show');
		});
	}
</script>
@endsection