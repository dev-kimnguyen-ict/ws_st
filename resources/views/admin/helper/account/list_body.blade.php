@foreach($accounts as $account)
<!-- A row of table -->
<tr class="row_9">
	<td><input type="checkbox" value="{{ $account->id }}" name="id[]"></td>
	<td class="textC">{{ $account->id }}</td>
	<td>{{ $account->name }}</td>
	<td class="">{{ $account->email }}</td>
	<td class="textC">{{ $account->phone }}</td>
	<td>{{ $account->address }}</td>
	<td class="textC">
		@if($account->actived)
		<span class="mark mark-blue center-block"/>
		@endif
	</td>
	<td class="textC">
		@if($account->blocked)
		<span class="mark mark-red center-block"/>
		@endif
	</td>
	<td class="textC">
		@if($account->groupid == 1)
		QTV
		@elseif($account->groupid == 2)
		NV
		@else
		TV
		@endif
	</td>
	<td>{{ $account->created_at }}</td>
	<td class="option textC">
		<a title="Xem chi tiết tài khoản" class="tipS" href="{{ route('admin.account.show', $account->id) }}">
			<img src="{{ URL::asset('contents/images/icons/color/view.png') }}">
		</a>
		<a class="tipS" title="Chỉnh sửa" href="{{ route('admin.account.edit', $account->id) }}">
			<img src="{{ URL::asset('contents/images/icons/color/edit.png') }}">
		</a>
		<a href="javascript:void(0)">
			{!! Form::open([
			'route' => ['admin.account.destroy', $account->id],
			'method' => 'DELETE'
			]) !!}
			{!! Form::submit('', ['class' => 'tipS btn-delete', 'title' => 'Xóa']) !!}
			{!! Form::close() !!}
		</a>
	</td>
</tr>
<!-- End a row of table -->
@endforeach