<div class="formRow">
	{!! Form::label('name', 'Họ tên:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<span class="oneTwo">
			{!! Form::text('name', null, ['_autocheck' => 'true']) !!}
		</span>
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error">
			@if ($errors->has('name'))
			{{ $errors->first('name') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('email', 'Email đăng nhập:', ['class' => 'formLeft', 'required' => 'true']) !!}
	<div class="formRight">
		<span class="oneTwo">
			{!! Form::email('email', null, [
			'_autocheck' => 'true',
			'class' => 'fix-form-input-email',
			'required' => 'true'
			])
			!!}
		</span>
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error">
			@if ($errors->has('email'))
			{{ $errors->first('email') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<!-- warranty -->
<div class="formRow">
	{!! Form::label('password', 'Mật khẩu:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<span class="oneFour">
			{!! Form::password('password', null, ['_autocheck' => 'true', 'required' => 'true']) !!}
		</span>
		<span class="autocheck" name="warranty_autocheck"></span>
		<div class="clear error" name="warranty_error">
			@if ($errors->has('password'))
			{{ $errors->first('password') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<!-- warranty -->
<div class="formRow">
	{!! Form::label('password_confirmation', 'Nhập lại mật khẩu:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<span class="oneFour">
			{!! Form::password('password_confirmation', null, ['_autocheck' => 'true', 'required' => 'true']) !!}
		</span>
		<span class="autocheck" name="warranty_autocheck"></span>
		<div class="clear error" name="warranty_error">
			@if ($errors->has('password_confirmation'))
			{{ $errors->first('password_confirmation') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('avatar', 'Hình đại diện:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<div class="left">
			{!! Form::file('avatar', null, ['_autocheck' => 'true']) !!}
		</div>
		<div class="clear error" name="image_error">
			@if ($errors->has('avatar'))
			{{ $errors->first('avatar') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('birthday', 'Ngày sinh:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('birthday', null, ['_autocheck' => 'true', 'required' => 'true']) !!}
			<span class="autocheck" name="name_autocheck"></span>
			<div class="clear error" name="name_error">
				@if ($errors->has('birthday'))
				{{ $errors->first('birthday') }}
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<div class="formRight">
		<div class="oneFour" style="position: relative;">
			<label for="nam">Nam giới:</label>
			<input type="radio" value="1" id="nam" checked="true" name="gender" style="position: absolute; top: 15%;" />
			<span class="autocheck" name="name_autocheck"></span>
			<div class="clear error" name="name_error">
				@if ($errors->has('birthday'))
				{{ $errors->first('birthday') }}
				@endif
			</div>
		</div>
		<div class="oneFour" style="position: relative; left: -60px;">
			<label for="nu">Nữ giới:</label>
			<input type="radio" value="0" id="nu" name="gender" style="position: absolute; top: 15%;" />
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('phone', 'Số điện thoại:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<span class="oneTwo">
			{!! Form::text('phone', null, ['_autocheck' => 'true', 'required' => 'true']) !!}
		</span>
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error">
			@if ($errors->has('phone'))
			{{ $errors->first('phone') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('address', 'Địa chỉ:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<span class="oneTwo">
			{!! Form::text('address', null, ['_autocheck' => 'true', 'required' => 'true']) !!}
		</span>
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error">
			@if ($errors->has('address'))
			{{ $errors->first('address') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<!-- Loại tài khoản -->
<div class="formRow">
	{!! Form::label('permiss', 'Trạng thái tài khoản:') !!}
	<div class="formRight">
		<div class="oneThree">
			{!! Form::select('groupid', [
					'1' => 'Quản trị viên',
					'2' => 'Nhân viên quản lý',
					'3' => 'Thành viên'
				], isset($account) ? $account->groupid : '3', ['required' => 'true', 'style' => 'width: 80%;'])
			!!}
			<div class="clear error" name="name_error">
				@if ($errors->has('permiss'))
				{{ $errors->first('permiss') }}
				@endif
			</div>
		</div>
		<div class="oneThree">
			{!! Form::select('actived', [
			'0' => 'Tài khoản chưa kích hoạt',
			'1' => 'Tài khoản đã kích hoạt'
			], isset($account) ? $account->actived : '1', ['required' => 'true', 'style' => 'width: 80%;'])
			!!}
			<div class="clear error" name="name_error">
				@if ($errors->has('actived'))
				{{ $errors->first('actived') }}
				@endif
			</div>
		</div>
		<div class="oneThree">
			{!! Form::select('blocked', [
				'0' => 'Không bị khóa',
				'1' => 'Khóa tài khoản'
				], isset($account) ? $account->blocked : '0', ['required' => 'true', 'style' => 'width: 80%;'])
			!!}
			<div class="clear error" name="name_error">
				@if ($errors->has('blocked'))
				{{ $errors->first('blocked') }}
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<!-- End loại tài khoản -->