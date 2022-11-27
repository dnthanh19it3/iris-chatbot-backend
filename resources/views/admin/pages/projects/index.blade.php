@extends("admin.layouts.layout")
@section("title", trans("app.web.project.title"))
@section("body")
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans("app.web.project.title") }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($data["projects"] as $project)
                            <div class="col-sm-3 mb-3" role="link" href="#">
                                <div class="position-relative p-3 border rounded">
                                    <div class="project-container">
                                        <div class="project-title">
                                            {{ $project->name }}
                                        </div>
                                        <div class="project-body">
                                            <img src="{{ asset("assets/images/avatar/sample-user-avatar.jpg") }}" class="project-body-img">
                                        </div>
                                        <div class="project-footer">
                                            <div class="action-bar">
                                                <div class="action-bar-item">
                                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-pause"></i>
                                                    </a>
                                                </div>
                                                <div class="action-bar-item">
                                                    <a href="#" class="btn btn-sm btn-success">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="action-bar-item">
                                                    <a href="#" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon {{ $project->status ? "bg-success" : "bg-danger" }}">
                                            {{ $project->status ? trans("app.web.project.status.running") : trans("app.web.project.status.paused") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@section("custom_css")

@endsection
