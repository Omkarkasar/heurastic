<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 40px;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .btn-primary,
        .btn-danger {
            min-width: 80px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Student Management System</h2>

        <!-- Buttons -->
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add teacher
            </button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>

        <!-- teacher Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter Teacher Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="SubmitForm" action="{{route('teacherstore')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id">
                            <div class="mb-3">
                                <label class="form-label">Teacher Name</label>
                                <input type="text" class="form-control" id="teachername" name="teachername" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="teacheremail" name="teacheremail" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- teacher Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white" id="datatable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Teacher Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be appended by jQuery -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            fetchTeachers();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // Teacher Form (Add or Update Teacher)
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
                var url = id ? `teacherupdate/${id}` : "{{ route('teacherstore') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#SubmitForm')[0].reset();
                        $('#exampleModal').modal('hide');
                        alert(response.success);
                        fetchTeachers();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });


            // Fetch Teacher Records
            function fetchTeachers() {
                $.ajax({
                    url: `teacherget`,
                    type: "GET",
                    success: function (response) {
                        var tbody = '';
                        $.each(response, function (i, teacher) {
                            tbody += `
                                <tr>
                                    <td>${teacher.id}</td>
                                    <td>${teacher.teachername}</td>
                                    <td>${teacher.teacheremail}</td>
                                
                                    <td>
                                        <button class="btn btn-success editBtn" data-id="${teacher.id}">Edit</button>
                                        <button class="btn btn-danger deleteBtn" data-id="${teacher.id}">Delete</button>
                                    </td>
                                </tr>`;
                        });
                        $('#datatable tbody').html(tbody);
                    }
                });
                   

            }
            fetchTeachers();  
            // Edit Teacher
            $(document).on('click', '.editBtn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: `teacheredit/${id}`,
                    type: "GET",
                    success: function (response) {
                        $('#id').val(response.id);
                        $('#teachername').val(response.teachername);
                        $('#teacheremail').val(response.teacheremail);
                        $('#exampleModal').modal('show');
                    }
                });
            });
              // Delete Teacher
              $(document).on('click', '.deleteBtn', function () {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this Teacher?')) {
                    $.ajax({
                        url: `teacherdelete/${id}`,
                        type: "DELETE",
                        data: { "_token": "{{csrf_token()}}" },
                        success: function (response) {
                            alert(response.success);
                            fetchTeachers();
                        }
                    });
                }
            });

        });
            </script>

</body>

</html>