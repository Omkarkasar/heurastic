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

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .btn-primary, .btn-danger {
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
                Add Student
            </button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>

        <!-- Student Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter Student Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="SubmitForm" action="{{route('studentstore')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id">
                            <div class="mb-3">
                                <label class="form-label">Student Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
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

        <!-- Student Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white" id="datatable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Of Birth</th>
                        <th>Phone</th>
                        <th>Address</th>
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

            // Submit Form (Add or Update Student)
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
                var url = id ? `studentupdate/${id}` : "{{ route('studentstore') }}";

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
                        fetchStudents();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            // Fetch Student Records
            function fetchStudents() {
                $.ajax({
                    url: `studentget`,
                    type: "GET",
                    success: function (response) {
                        var tbody = '';
                        $.each(response, function (i, student) {
                            tbody += `
                                <tr>
                                    <td>${student.id}</td>
                                    <td>${student.name}</td>
                                    <td>${student.email}</td>
                                    <td>${student.dob}</td>
                                    <td>${student.phone}</td>
                                    <td>${student.address}</td>
                                    <td>
                                        <button class="btn btn-success editBtn" data-id="${student.id}">Edit</button>
                                        <button class="btn btn-danger deleteBtn" data-id="${student.id}">Delete</button>
                                    </td>
                                </tr>`;
                        });
                        $('#datatable tbody').html(tbody);
                    }
                });
            }
            fetchStudents();

            // Edit Student
            $(document).on('click', '.editBtn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: `studentedit/${id}`,
                    type: "GET",
                    success: function (response) {
                        $('#id').val(response.id);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#dob').val(response.dob);
                        $('#phone').val(response.phone);
                        $('#address').val(response.address);
                        $('#exampleModal').modal('show');
                    }
                });
            });

            // Delete Student
            $(document).on('click', '.deleteBtn', function () {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this student?')) {
                    $.ajax({
                        url: `studentdelete/${id}`,
                        type: "DELETE",
                        data: { "_token": "{{csrf_token()}}" },
                        success: function (response) {
                            alert(response.success);
                            fetchStudents();
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
