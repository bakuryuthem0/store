<div class="response">
	<div class="new-comment media response-info hidden">
		<div class="media-left response-text-left">
			<a href="#">
				<img class="media-object img-circle avatar" src="" alt="" />
			</a>
			<h5><a href="#" class="username"></a></h5>
		</div>
		<div class="media-body response-text-right">
			<p class="comment"></p>
			<ul>
				<li class="date created_at"></li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	@foreach($comments as $c)
		<div class="media response-info">
			<div class="media-left response-text-left">
				<a href="#">
					<img class="media-object img-circle" src="{{ asset('images/avatars/'.$c->users->avatar) }}" alt="" />
				</a>
				<h5><a href="#!">{{ $c->users->name.' '.$c->users->lastname }}</a></h5>
			</div>
			<div class="media-body response-text-right">
				<p>{{ $c->comment }}</p>
				<ul>
					<li class="date">
						{{ date('F-d',strtotime($c->created_at)) }}
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	@endforeach
	
</div>
@if(Auth::check())
<div class="">
	<hr>
	<h3>{{ Lang::get('lang.comment_title') }}</h3>
	<div class="formulario">
		<div class="alert responseAjax">
			<p></p>
		</div>
		<textarea class="form-control comment-textarea" placeholder="{{ Lang::get('lang.comment_placeholder') }}"></textarea>
	</div>
	<div class="formulario">
		<button class="btn btn-comment third" data-target="new-comment" value="{{ $item->id }}">{{ Lang::get('lang.btn_send') }}</button>
		<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
	</div>
</div>
@endif