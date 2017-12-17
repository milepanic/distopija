<div class="col-md-6">
	<ul class="nav nav-tabs">
		<li class="{{ Request::is('profile/' . $user->slug) ? 'active' : '' }}">
			<a class="tab" data-type="{{ 'profile/' . $user->slug }}" href="#">
				Vicevi ({{ $user->posts_count }})
			</a>
		</li>
		<li class="{{ Request::is('profile/' . $user->slug . '/original') ? 'active' : '' }}">
			<a class="tab" data-type="{{ 'profile/' . $user->slug . '/original' }}" href="#">
				Original ({{ $user->original_count }})
			</a>
		</li>
		<li class="{{ Request::is('profile/' . $user->slug . '/favorites') ? 'active' : '' }}">
			<a class="tab" data-type="{{ 'profile/' . $user->slug . '/favorites' }}" href="#">
				Favorites ({{ $user->favorite_count }})
			</a>
		</li>
	</ul>
	<div class="container">
		<div id="user-data">

			@include('includes.jokes')
			
		</div>
	</div>
</div>