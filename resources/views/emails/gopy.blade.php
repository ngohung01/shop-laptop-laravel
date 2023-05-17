<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Phản hồi - {{ config('app.name', 'Laravel') }}</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		p {
			margin-top: 3px;
			margin-bottom: 3px;
		}
	</style>
</head>

<body>
	<p>Xin chào {{ $gopy->name }}!</p>
	<p>Xin cảm ơn bạn đã góp ý cho {{ config('app.name', 'Laravel') }}.</p>
	<p>Thông tin khách hàng</p>
	<p>- Tên khách hàng: <strong>{{ $gopy->name }}</strong></p>
	<p>- Email: <strong>{{ $gopy->email }}</strong></p>
    <p>- Số điện thoại: <strong>{{ $gopy->sodienthoai }}</strong></p>
	
	<p>Nội dung góp ý bao gồm:</p>
	<table border="1">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th>Chủ đề</th>
				<th width="25%">Nội dung</th>
				<th width="25%">Phản hồi từ shop</th>
			</tr>
		</thead>
		<tbody>
			
				<tr align="center">
					<td>1</td>
					<td>@if($gopy->chude==1)
								Góp ý
								@else
								Lỗi
								@endif</td>
					<td>{{$gopy->noidung}}</td>
					<td>{{$gopy->phanhoi}}</td>
				</tr>
            
		</tbody>
	</table>
	
	<p>Trân trọng,</p>
	<p><strong>{{ config('app.name', 'Laravel') }}</strong></p>
</body>

</html>