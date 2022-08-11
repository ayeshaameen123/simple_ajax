<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
            crossorigin="anonymous"></script>
    <script src="{{asset('jquery/jquery-3.6.0.min.js')}}"></script>

</head>
<body>
<div class="container">
    <h1 class="mt-5 text-center">Crud With Ajax</h1>
    <div class="row">
        <div class="col-6">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Roll#</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableData">

                </tbody>
            </table>
        </div>
        <div class="col-6">
            <h1 class="mt-5 text-center">Insert Data</h1>
            <form id="user-frm">
                <input type="hidden" id="id" name="id">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">DOB</label>
                    <input type="date" class="form-control" id="dob" name="dob">
                </div>
                <div class="mb-3">
                    <label for="roll_no" class="form-label">Roll_no</label>
                    <input type="text" class="form-control" id="roll_no" name="roll_no">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea rows="2" class="form-control" id="address" name="address"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        getData();
        $('#user-frm').submit(function (e) {
            e.preventDefault();
            var token = $('#token').val();
            var email = $('#email').val();
            var dob = $('#dob').val();
            var roll_no = $('#roll_no').val();
            var address = $('#address').val();
            var name = $('#name').val();
            var last_name = $('#last_name').val();
            var id = $('#id').val();
            $.ajax({
                url: 'add_data',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'email': email,
                    'dob': dob,
                    'name': name,
                    'last_name': last_name,
                    'roll_no': roll_no,
                    'address': address,
                    'id': id,
                },
                success: function (res, status) {
                    if (status == 'success') {
                        getData();
                        $('#email').val('');
                        $('#name').val('');
                        $('#last_name').val('');
                        $('#roll_no').val('');
                        $('#address').val('');
                        $('#dob').val('');
                    }
                }
            });
        })

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('show') }}",
                data: {
                    'id': id,
                    "_token": "{{ csrf_token() }}",
                },
                // dataType: 'json',
                success: function (res) {
                    $('#email').val(res['email']);
                    $('#name').val(res['name']);
                    $('#last_name').val(res['last_name']);
                    $('#address').val(res['address']);
                    $('#dob').val(res['dob']);
                    $('#roll_no').val(res['roll_no']);
                    $('#id').val(res['id']);
                }
            });
        });

        $('body').on('click', '.del', function () {
            var id = $(this).data('id');
            var token = $('#token').val();
            $.ajax({
                type: "POST",
                url: "{{ url('delete') }}",
                data: {
                    'id': id,
                    "_token": "{{ csrf_token() }}",
                },
                // dataType: 'json',
                success: function (res, status) {
                    if (status == 'success') {
                        // window.location.reload();
                        getData();
                    }
                }
            });

        });
    });

    function getData() {
        $.ajax({
            url: 'view',
            type: 'get',
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    $('#tableData').html(res.myTable);
                }
            }
        });
    }

</script>
</body>
</html>

