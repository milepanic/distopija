@extends('admin.master')

@section('content')

	<div class="row">
	    <div class="col-lg-12">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table id="dataTable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Registered</th>
                                <th>Last active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)

                            <tr>
                                <td @if($user->banned_until)
                                		class="text-danger"
                                	@endif
                                >
                                	<a href="{{ url('profile/' . $user->slug) }}">{{ $user->name }}</a>
                                </td>
                                <td>{{ $user->points }}</td>
                                <td>
                                	{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                </td>
                                <td>
                                	<a href="https://laracasts.com/discuss/channels/laravel/update-users-last-activity/replies/189841">
                                		Coming Soon
                                	</a>
                                	<a href="https://laravel.io/forum/03-03-2014-sentry-3-users-online"> Alt</a>
                                </td>
                                <!-- Modal -->
                                <td>
                                	<a class="text-danger ban" title="Ban user {{ $user->name }}"
                                        data-toggle="modal" data-target="#myModal" data-name="{{ $user->name }}" data-id="{{ $user->id }}">
                                		<i class="fa fa-ban" aria-hidden="true"></i>
                                	</a>&nbsp;
                                	<a class="text-success" title="Unban user {{ $user->name }}"
                                		href="users/unban/{{ $user->id }}">
                                		<i class="fa fa-check" aria-hidden="true"></i>
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

     <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form class="modal-form" method="POST">
                    {{ CSRF_FIELD() }}
                    <p>Choose ban date</p>
                    <input name="date" type="date" class="form-control">
                    <br>
                    <p>Write a reason for ban</p>
                    <input name="reason" type="text" class="form-control" placeholder="Reason" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Ban</button>
                    <button class="btn btn-info" data-dismiss="modal">Return</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @section('external-js')
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
        });

        $('.ban').click(function (event) {
            var name = $(this).data('name');
            var id = $(this).data('id');            
            
            var modal = $("#myModal");
            modal.find('.modal-form').attr('action', 'users/ban/' + id);
            modal.find('.modal-title').text('You are banning ' + name);
        });

    </script>
    @endsection

@endsection