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
                Add enrollment
            </button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>

        <!-- enrollment Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter enrollment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="SubmitForm" action="{{route('enrollmentstore')}}" method="POST">
                        @csrf   
                        <input type="hidden" id="enrollment_id">
                            <div class="mb-3">
                                <label class="form-label">Student:</label>
                                <input type="hidden" name="id" id="id">
                                <select class="form-control" id="studentid" name="studentid">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course:</label>
                                <select class="form-control" id="courseid" name="courseid">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->coursename }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Enrollment Date:</label>
                                <input type="date" class="form-control" id="enrollmentdate" name="enrollmentdate">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Enrollment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- enrollment Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white" id="datatable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Course ID</th>
                        <th>Enrollment Date</th>
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
            fetchenrollments();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // Submit Form (Add or Update enrollment)
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
                var url = id ? `enrollmentupdate/${id}` : "{{ route('enrollmentstore') }}";

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
                        fetchenrollments();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });
            function fetchenrollments() {
                $.ajax({
                    url: `enrollmentget`,
                    type: "GET",
                    success: function (response) {
                        var tbody = '';
                        $.each(response, function (i, enrollment) {
                            tbody += `
                                <tr>
                                    <td>${enrollment.id}</td>
                                    <td>${enrollment.studentid}</td>
                                    <td>${enrollment.courseid}</td>
                                    <td>${enrollment.enrollmentdate}</td>
                                </tr>`;
                        });
                        $('#datatable tbody').html(tbody);
                    }
                });
            }
            fetchenrollments();
             });
    </script>

</body>

</html>