@extends('admin.layouts.app')


@section('content')

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
                    <h1 class="m-0">Add link</h1>
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
    <div class="card card-info" style="border: 1px solid #ccc;">
        <div class="card-header" style="height: 62px;">
            <h3 class="card-title">Add New link <small></small></h3>
        </div>
        <div class="container">
            <form action="{{ route('create-link') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <!-- Form inputs here -->
                    <div class="form-group">
                        <label style="margin-top:10px;" for="exampleInputEmail1">SEO link
                        <!-- <span style="color:red">*(**INCLUDE CONTENT ONLY.DONT PUT FULL LINK**)Google</span> -->
                    </label>
                        <input type="text" name="scolink" class="form-control" id="exampleInputEmail1" placeholder="" value="" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center mt-1 mb-2">


                </div>
                {{-- Start - Content comes here --}}
                <div class="col-12">
                    @include('admin.layouts.message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
<p>(**only first link will be work.If exists please delete**)</p>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Link</th>
                    <th>Edit & Delete</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp

                @foreach ($getRecord as $value)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $value->scolink }}</td>
                    <td>
                        <a href="{{url('admin/link/edit/'.$value->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{url('admin/seo/delete/'.$value->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

                        <!-- /.card-body -->
                    </div>
                </div>









                {{-- End - Content comes here --}}
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@section('style')
<!-- Include jQuery -->

<!-- Initialize Select2 -->




</section>
</main>
@endsection