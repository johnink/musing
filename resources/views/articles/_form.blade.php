
		<div class="form-group">

			{!! Form::label('title','Title:')!!}

			{!! Form::text('title',null,['class' => 'form-control'])!!}

		</div>

		<div class="form-group">

			{!! Form::label('published_at','Publish On:')!!}


			{!! Form::date('published_at',$article->published_at->format('Y-m-d'),['class' => 'form-control'])!!}

		</div>

		<div class="form-group">

			{!! Form::label('body','Body:')!!}

			{!! Form::textarea('body',null,['class' => 'form-control'])!!}

		</div>

		<div class="form-group">

			{!! Form::label('excerpt','Excerpt:')!!}

			{!! Form::textarea('excerpt',null,['class' => 'form-control','maxlength' => '500'])!!}

		</div>


		<div class="form-group">

			{!! Form::label('description','Description:')!!}

			{!! Form::text('description',null,['class' => 'form-control','maxlength' => '255'])!!}

		</div>


		<div class="form-group">

			{!! Form::label('category','Category:')!!}

			{!! Form::select('category',['blog'=>'Blog','things'=>'Things to Consider','guest'=>'Guest article','game'=>'New Game','recommendation'=>'Recommendation','spotlight'=>'Spotlight'],null,['class' => 'form-control'])!!}

		</div>

		<div class="form-group">

			{!! Form::label('tagList','Tags:')!!}

			{!! Form::select('tagList[]',$tags,null,['class' => 'form-control','multiple'])!!}

		</div>

		<div class="form-group">


			{!! Form::label('draft','Save as draft : ')!!}

			{!! Form::hidden('draft', false) !!}

			{!! Form::checkbox('draft', 1, $article->draft) !!}

		</div>

		<div class="button" onClick="preview()">Preview</div><br />

		<div class="form-group">
			{!! Form::submit($submitButtonText, ['class'=>'button']) !!}
		</div>