{!! Form::open([
	'route' => 'admin.account.filter',
	'method' => 'GET',
	'class' => 'list_filter form',
	'id' => 'list_filter_form'
]) !!}
<table width="100%" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td class="label" style="width:20px;">
				{!! Form::label('id', 'Mã số:') !!}
			</td>
			<td class="item" style="width: 40px;">
				{!! Form::text('id', isset($_GET['id']) ? $_GET['id'] : null, [
						'style' 		=> 'width: 90%;',
						'placeholder'	=> 'Mã tài khoản'
					])
				!!}
			</td>
			<td class="label" style="width:30px;">
				{!! Form::label('text', 'Từ khóa:') !!}
			</td>
			<td class="item" style="width: 115px;">
				{!! Form::text('text', isset($_GET['text']) ? $_GET['text'] : null, [
						'style' 		=> 'width: 90%;',
						'placeholder' 	=> 'Nhập email hoặc họ tên'
					])
				!!}
			</td>
			<td class="item" style="width: 70px;">
				{!! Form::select('permiss', [
					'' => '-- Chọn cấp độ',
					'1' => 'Quản trị viên',
					'2' => 'Nhân viên',
					'3' => 'Thành viên'
					], isset($_GET['permiss']) ? $_GET['permiss'] : '', ['style' => 'width: 90%;']
				) !!}
			</td>
			<td class="item" style="width:85px;">
				{!! Form::select('actived', [
					''  => '-- Chọn TT kích hoạt',
					'0' => 'Chưa kích hoạt',
					'1' => 'Đã kích hoạt'
					], isset($_GET['actived']) ? $_GET['actived'] : '', ['style' => 'width: 90%;']
				) !!}
			</td>
			<td class="item" style="width: 75px;">
				{!! Form::select('blocked', [
					'' 	=> '-- Chọn TT khóa',
					'0' => 'Không bị khóa',
					'1' => 'Đã bị khóa'
					], isset($_GET['blocked']) ? $_GET['blocked'] : '', ['style' => 'width: 90%;']
				) !!}
			</td>
			<td style="width:80px">
				{!! Form::submit('Lọc', ['class' => 'button blueB']) !!}
				{!! Form::reset('Xóa lọc', ['class' => 'basic']) !!}
			</td>
		</tr>
	</tbody>
</table>
{!! Form::close() !!}