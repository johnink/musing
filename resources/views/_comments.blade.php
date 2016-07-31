{{--
{!! Form::model($article = new \App\Article, ['url' => 'comment']) !!}

	<div class="form-group">
		{!! Form::label('type','Contribute:')!!}

		{!! Form::select('type',['tip'=>'User Tip','comment'=>'Just a Comment'])!!}

	</div>

	<div class="form-group">


			{!! Form::textarea('body',null,['class' => 'form-control'])!!}

	</div>

	<div class="form-group">
		{!! Form::submit("Submit", ['class'=>'button']) !!}
	</div>
{!! Form::close() !!}
--}}