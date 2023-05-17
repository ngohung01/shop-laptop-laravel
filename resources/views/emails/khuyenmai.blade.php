<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Khuyến mãi - {{ config('app.name', 'Laravel') }}</title>
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
	<p>Xin chào {{ Auth::user()->name }}!</p>
	<p>{{ config('app.name', 'Laravel') }} xin gửi tặng bạn mã khuyến mãi</p>
	<table border="1">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th>Tên mã khuyến mãi</th>
				<th width="5%">Mã khuyến mãi</th>
				<th width="15%">Giảm giá</th>
                <th width="15%">Số lượng</th>
                <th width="15%">Ngày bắt đầu</th>
                <th width="15%">Ngày kết thúc</th>
			</tr>
		</thead>
		<tbody>
			
				<tr>
					<td>1</td>
					<td>{{$khuyenmai->tenkhuyenmai}}</td>
                    <td>{{$khuyenmai->makhuyenmai}}</td>
					<td>{{$khuyenmai->giamgia}}</td>
                    <td>{{$khuyenmai->soluong}}</td>
                    <td>{{$khuyenmai->ngaybatdau}}</td>
                    <td>{{$khuyenmai->ngayketthuc}}</td>
				</tr>
            
		</tbody>
	</table>
	
	<p>Trân trọng,</p>
	<p>{{ config('app.name', 'Laravel') }}</p>
</body>

</html>000