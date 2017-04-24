{!! Form::open([
	'route' => 'admin.category.filter',
	'method' => 'GET',
	'class' => 'list_filter form',
	'id' => 'list_filter_form'
]) !!}
<table width="100%" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td class="label" style="width:30px;">
				{!! Form::label('ma_so', 'Mã số:') !!}
			</td>
			<td class="item" style="width: 55px;">
				{!! Form::text('ma_so', isset($_GET['id']) ? $_GET['ma_so'] : null, ['style' => 'width: 85%;']) !!}
			</td>
			<td class="label" style="width:30px;">
				{!! Form::label('ten_danh_muc', 'Tên danh mục:') !!}
			</td>
			<td class="item" style="width: 155px;">
				{!! Form::text('ten_danh_muc', isset($_GET['ten_danh_muc']) ? $_GET['ten_danh_muc'] : null, ['style' => 'width: 85%;']) !!}
			</td>
			<!-- <td class="item" style="width: 80px;">
				{!! Form::select('actived', [
					'0' => 'Chưa kích hoạt',
					'1' => 'Đã kích hoạt'
					], isset($_GET['actived']) ? $_GET['actived'] : '1', ['style' => 'width: 80%;']
				) !!}
			</td>
			<td class="item" style="width: 80px;">
				{!! Form::select('blocked', [
					'0' => 'Không bị khóa',
					'1' => 'Đã bị khóa'
					], isset($_GET['blocked']) ? $_GET['blocked'] : '0', ['style' => 'width: 80%;']
				) !!}
			</td> -->
			<td style="width:80px">
				{!! Form::submit('Lọc', ['class' => 'button blueB']) !!}
				{!! Form::reset('Xóa lọc', ['class' => 'basic']) !!}
			</td>
		</tr>
	</tbody>
</table>
{!! Form::close() !!}