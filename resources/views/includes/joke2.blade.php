		<!-- Main Content Post Versions -->

		<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block">
				<article class="hentry post">

					<div class="post__author author vcard inline-items">
						<img src="{{ asset('images/users/' . $post->user->id . '.png') }}" alt="">

						<div class="author-date">
							<a class="h6 post__author-name fn" 
								href="{{ url('profile/' . $post->user->slug) }}">
									{{ $post->user->name }}
							</a>
							<div class="post__date">
								<a href="{{ url('v/' . $post->id) }}">
									<time class="published">
										{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
									</time>
								</a>
							</div>
						</div>

						

					</div>

					<p>{{ $post->content }}</p>

					<div class="post-additional-info inline-items">

						<a href="#" class="post-add-icon inline-items">
							<i class="fa fa-thumbs-up"></i>
							<span>000</span>
						</a>

						<a href="#" class="post-add-icon inline-items">
							<i class="fa fa-thumbs-down"></i>
							<span>000</span>
						</a>

						<a href="#" class="post-add-icon inline-items">
							<i class="fa fa-star"></i>
							<span>000</span>
						</a>

						<div class="comments-shared">
							<a href="#" class="post-add-icon inline-items">
								<i class="fa fa-comments"></i>
								<span>000</span>
							</a>

							<a href="#" class="post-add-icon inline-items">
								<i class="fa fa-share"></i>
								<span>000</span>
							</a>
						</div>


					</div>

					<div class="control-block-button post-control-button">

						<a href="#" class="btn btn-control">
							<svg class="olymp-like-post-icon"><use xlink:href="icons/icons.svg#olymp-like-post-icon"></use></svg>
						</a>

						<a href="#" class="btn btn-control">
							<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
						</a>

						<a href="#" class="btn btn-control">
							<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
						</a>

					</div>

				</article>

				<ul class="comments-list">
					
					<li class="has-children">
						<div class="post__author author vcard inline-items">
							<img src="img/avatar5-sm.jpg" alt="author">

							<div class="author-date">
								<a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
								<div class="post__date">
									<time class="published" datetime="2017-03-24T18:18">
										1 hour ago
									</time>
								</div>
							</div>

							<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

						</div>

						<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugiten, sed quia
							consequuntur magni dolores eos qui ratione voluptatem sequi en lod nesciunt. Neque porro
							quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur adipisci velit en lorem ipsum der.
						</p>

						<a href="#" class="post-add-icon inline-items">
							<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
							<span>5</span>
						</a>
						<a href="#" class="reply">Reply</a>

						<ul class="children">
							<li>
								<div class="post__author author vcard inline-items">
									<img src="img/avatar8-sm.jpg" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="#">Diana Jameson</a>
										<div class="post__date">
											<time class="published" datetime="2017-03-24T18:18">
												39 mins ago
											</time>
										</div>
									</div>

									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

								</div>

								<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>2</span>
								</a>
								<a href="#" class="reply">Reply</a>
							</li>
						</ul>
					</li>
				</ul>

				<a href="#" class="more-comments">View more comments <span>+</span></a>
				<form class="comment-form inline-items">

					<div class="post__author author vcard inline-items">
						<img src="{{ asset('images/users/' . Auth::id() . '.png') }}" alt="author">

						<div class="form-group with-icon-right ">
							<textarea class="form-control" placeholder="Prokomentarisi..."></textarea>
						</div>
					</div>

					<button class="btn btn-md-2 btn-primary">Postavi Komentar</button>

					<button class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">Obustavi</button>

				</form>
			</div>
		</div>

		<!-- ... end Main Content Post Versions -->
	