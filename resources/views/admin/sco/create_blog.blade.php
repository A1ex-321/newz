@extends('admin.layouts.app')

<!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
<style type="text/css">
    .ck-editor__editable_inline {
        height: 470px;
    }

    @media (min-width: 1200px) {
        .container {
            width: 996px !important;
        }
    }
</style>


<head>
    <!-- ... (other scripts) ... -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head>
<!-- SweetAlert2 CSS -->

<main id="main" class="main">
    <section class="section dashboard" style="margin-left: -260px;
">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-0">
                        <div class="col-sm-6">
                            @can('create posts')
                            <h1 class="m-0">Add blog</h1>
                            @endcan


                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"></li>




                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header" style="background-color:
#6e9ee6
;">
                                    @can('create posts')

                                    <h3 class="card-title">Add Blog data <small></small></h3>
                                </div>
                                <div class="container">
                                    <form action="{{ route('create-blogsco') }}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}


                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Category<span style="color:red">*</span></label>
                                                        <select name="category" id="category" class="form-control" required>
                                                            <option value="" selected disabled>Please select a category</option>
                                                            @foreach($getRecord as $record)
                                                            <option value="{{ $record->id }}">{{ $record->category }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Category1<span style="color:red">*</span></label>
                                                        <select name="countries" id="countries" multiple>
                                                            <option value="1">Afghanistan</option>
                                                            <option value="2">Australia</option>
                                                            <option value="3">Germany</option>
                                                            <option value="4">Canada</option>
                                                            <option value="5">Russia</option>
                                                        </select>
                                                    </div>
                                                </div>










                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Title<span style="color:red">*</span></label>
                                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Title" value="{{ old('title') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Thumb Image<span style="color:red">*</span></label>
                                                        <input type="file" name="image" class="form-control" id="exampleInputEmail1" placeholder="Image" value="{{ old('image') }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Description<span style="color:red"></span></label>
                                                <textarea name="description" class="form-control" id="exampleInputEmail1" placeholder="Description" style="width: 100%; height: 100px;">{{ old('description') }}</textarea>


                                            </div>
                                            <div class="form-group">
                                                <label for="editor">Content</label>
                                                <textarea name="content" id="description" cols="30" rows="10"></textarea>
                                            </div>


                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </div>
                                    </form>
                                    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
                                    <script>
                                        new MultiSelectTag('countries') // id
                                    </script>
<script>
    $(document).ready(function() {
        $('#countries').select2();
    });
</script>


                                </div>
                                @endcan


                            </div>
                        </div>
                    </div>
                </div>
            </div>



            @include('admin.layouts.message')

            <!-- Main content -->

            <!-- /.content -->
        </div>






        <script>
            $('#description').summernote({
                placeholder: 'description...',
                tabsize: 1,
                height: 300
            });
        </script>
        </script>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            // Function to check the availability of the slug
            function checkSlugAvailability() {
                const slugInput = $('input[name="slug"]');
                const slugValue = slugInput.val();

                // Make an AJAX request to your Laravel route
                $.ajax({
                    url: '/check-slug-availability',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Ensure proper syntax
                        slug: slugValue
                    },
                    success: function(response) {
                        const messageElement = $('#slugAvailabilityMessage');

                        if (response.available) {} else {
                            messageElement.text('Slug already exists. Please choose another one.');
                        }
                    },
                    error: function(error) {
                        console.error('Error checking slug availability:', error);
                    }
                });
            }
            // Attach the function to the 'change' event of the slug input
            $('input[name="slug"]').on('change', checkSlugAvailability);
        </script>
    </section>
</main>

@endsection




@section('style')
<!-- Include jQuery -->

<!-- Initialize Select2 -->





@endsection