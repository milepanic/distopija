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
                                <td class="col-md-4">{{ $post->content }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->original }}</td>
                                <td>{{ $post->category }}</td>
                                <td> {{ $post->upvotes }} </td>
                                <td> {{ $post->downvotes }} </td>
                                <td> {{ $post->favorites }} </td>
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
                <!-- /.table-responsive -->
                <div class="well">
                    <h4>DataTables Usage Information</h4>
                    <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                    <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                </div>
            </div>
	    </div>
	</div>

@endsection