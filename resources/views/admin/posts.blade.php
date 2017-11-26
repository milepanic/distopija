@extends('admin.master')

@section('content')

	<div class="row">
	    <div class="col-lg-12">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>Joke</th>
                                <th>Posted by</th>
                                <th>Original</th>
                                <th>Category</th>
                                <th>Upvotes</th>
                                <th>Downvotes</th>
                                <th>Favorites</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($posts as $post)

                            <tr>
                                <td class="col-md-3">{{ $post->content }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->original }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> 
                                	{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                </td>
                                <td>
                                	<a class="text-danger" href="posts/delete/{{ $post->id }}">
                                		<i class="fa fa-trash" aria-hidden="true"></i>
                                	</a>
                                </td>
                            </tr>

						@endforeach

                        </tbody>
                    </table>
                </div>
            </div>
	    </div>
	</div>

@endsection