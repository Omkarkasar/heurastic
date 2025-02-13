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
                Add course
            </button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>

        <!-- course Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter course Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="SubmitForm" action="{{route('coursestore')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id">
                            <div class="mb-3">
                                <label class="form-label">course Name</label>
                                <input type="text" class="form-control" id="coursename" name="coursename" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">course Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course Duration(in Week)</label>
                                <input type="number" class="form-control" id="duration" name="duration" required>
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

        <!-- course Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white" id="datatable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Duration</th>
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
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // Submit Form (Add or Update course)
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
                var url = id ? `courseupdate/${id}` : "{{ route('coursestore') }}";

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
                        fetchcourses();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });
            // Fetch course Records
            function fetchcourses() {
                $.ajax({
                    url: `courseget`,
                    type: "GET",
                    success: function (response) {
                        var tbody = '';
                        $.each(response, function (i, course) {
                            tbody += `
                                <tr>
                                    <td>${course.id}</td>
                                    <td>${course.coursename}</td>
                                    <td>${course.description}</td>
                                    <td>${course.duration}</td>
                                    <td>
                                        <button class="btn btn-success editBtn" data-id="${course.id}">Edit</button>
                                        <button class="btn btn-danger deleteBtn" data-id="${course.id}">Delete</button>
                                    </td>
                                </tr>`;
                        });
                        $('#datatable tbody').html(tbody);
                    }
                });
            }
            fetchcourses();
            // Edit course
            $(document).on('click', '.editBtn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: `courseedit/${id}`,
                    type: "GET",
                    success: function (response) {
                        $('#id').val(response.id);
                        $('#coursename').val(response.coursename);
                        $('#description').val(response.description);
                        $('#duration').val(response.duration);
                        $('#exampleModal').modal('show');
                    }
                });
            });
              // Delete course
              $(document).on('click', '.deleteBtn', function () {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this course?')) {
                    $.ajax({
                        url: `coursedelete/${id}`,
                        type: "DELETE",
                        data: { "_token": "{{csrf_token()}}" },
                        success: function (response) {
                            alert(response.success);
                            fetchcourses();
                        }
                    });
                }
            });

        });
    </script>

</body>

</html>