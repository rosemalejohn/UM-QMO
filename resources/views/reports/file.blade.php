<!DOCTYPE html>
<html>
<head>
	<title>File Reports</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		th,td{
			padding: 5px;
		}
	</style>
</head>
<body>
	<tr>
		<th colspan="8" align="center">
			<h1>University of Mindanao</h1>
		</th>
	</tr>
	<tr>
		<th colspan="8" align="center">
			<h3>QMO File Report</h3>
		</th>
	</tr>
	<tr><td colspan="8"></td></tr>
	<tr>
		<th></th>
		<th>Filename</th>
		<th>Description</th>
		<th>Size</th>
		<th>Category</th>
		<th>Department</th>
		<th>Uploaded by</th>
		<th>Upload date</th>
	</tr>
	@foreach($files as $key => $file)
	<tr>
		<td>{{$key+1}}</td>
		<td>{{$file->filename}}</td>
		<td>{{$file->description}}</td>
		<td>{{$file->size}} kb</td>
		<td>{{$file->category ? $file->category->name : ''}}</td>
		<td>{{$file->department ? $file->department->name : ''}}</td>
		<td>{{$file->user->name}}</td>
		<td>{{$file->created_at}}</td>
	</tr>
	@endforeach
</body>
</html>
