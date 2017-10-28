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
                                <th>Name</th>
                                <th>NSFW</th>
                                <th>Cover Box</th>
                                <th>Pictures</th>
                                <th>Videos</th>
                                <th>Created at</th>
                                <th>Approved</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)

                            <tr>
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->nsfw }} </td>
                                <td> {{ $category->cover_box }} </td>
                                <td> {{ $category->pictures }} </td>
                                <td> {{ $category->videos }} </td>
                                <td> 
                                	{{ \Carbon\Carbon::parse($category->updated_at)->diffForHumans() }}
                                </td>
                                <td> 
                                	@if($category->approved === 0)
                                		Waiting
                                	@elseif($category->approved === 1)
                                		Rejected
                                	@else
                                		Approved
									@endif
                                </td>
                                <td>
                                	<a href="categories/approve/{{ $category->id }}">
                                		<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                	</a>&nbsp;
                                	<a class="text-danger" href="categories/reject/{{ $category->id }}">
                                		<i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                	</a>&nbsp;
                                	<a class="text-muted" href="categories/delete/{{ $category->id }}">
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