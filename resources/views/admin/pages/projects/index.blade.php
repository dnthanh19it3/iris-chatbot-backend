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
                        <a href="#" id="login-btn">Log in with Facebook</a>
                        {{--                        <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="rounded" data-use-continue-as="true"></div>--}}
                        @foreach($data["projects"] as $project)
                            <div class="col-sm-3 mb-3" role="link" href="#">
                                <div class="position-relative p-3 border rounded">
                                    <div class="project-container">
                                        <div class="project-title">
                                            {{ $project->name }}
                                        </div>
                                        <div class="project-body">
                                            <img src="{{ asset("assets/images/avatar/sample-user-avatar.jpg") }}"
                                                 class="project-body-img">
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
    <!-- Modal -->
    <div class="modal fade" id="linkingModal" tabindex="-1" role="dialog" aria-labelledby=linkingModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-search"></i> Chose page to linking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form>
                       <h5>Congrate! You just authorize use to access your page. Let choose which page to linking with our platform  </h5>
                       <div class="form-group" id="listPageDiv">

                       </div>
                       <input type="hidden" id="userID">
                       <input type="hidden" id="accessToken">
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("custom_css")

@endsection
@section("custom_js")
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '1125732181473704',
                autoLogAppEvents: true,
                xfbml: true,
                version: 'v15.0'
            });
        };
    </script>
    <script type="text/javascript">
        document.getElementById('login-btn').onclick = function () {
            FB.login(function (response) {
                console.log('FB.login response', response);
                let data = JSON.stringify({
                    accessToken: response.authResponse.accessToken,
                    userID: response.authResponse.userID
                });
                console.log(data);

                // console.log(response);
                // Request
                let req = new XMLHttpRequest();
                req.open("POST", "https://quocthinh.iristech.live/api/social/facebook/login_callback", false);
                req.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                req.send(data);
                // Result list page
                console.log(req.response);
                let listPageResponse = JSON.parse(req.response);
                console.log(listPageResponse.data);
                // Show modal
                $("#linkingModal").modal();
                if(listPageResponse.data.length > 0){
                    alert("check");
                    let innerCheckbox = "";
                    listPageResponse.data.forEach((item) => {
                       innerCheckbox += `
                            <div class="form-check">
                               <input class="form-check-input" type="checkbox" name="pageID[]" value="${item.id}">
                               <label class="form-check-label">${item.name}</label>
                           </div>
                       `
                    });
                    $("#listPageDiv").html(innerCheckbox);
                    $("#userID").val(listPageResponse.userID);
                    $("#accessToken").val(listPageResponse.accessToken);
                }

            }, {scope: 'pages_manage_metadata, pages_messaging', return_scopes: true, enable_profile_selector: true});

            // FB.getLoginStatus(function (response) {
            //     if (response.status === 'connected') {
            //         let data = JSON.stringify({
            //             accessToken: response.authResponse.accessToken,
            //             userID: response.authResponse.userID
            //         });
            //         console.log(data);
            //         // console.log(response);
            //         // Request
            //         let req = new XMLHttpRequest();
            //         req.open("POST", "https://quocthinh.iristech.live/api/social/facebook/login_callback", false);
            //         req.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
            //         req.send(data);
            //         // Result
            //         console.log(req.response);
            //
            //     } else {
            //         FB.login(function (response) {
            //             console.log('FB.login response', response);
            //             let data = JSON.stringify({
            //                 accessToken: response.authResponse.accessToken,
            //                 userID: response.authResponse.userID
            //             });
            //             console.log(data);
            //             // console.log(response);
            //             // Request
            //             let req = new XMLHttpRequest();
            //             req.open("POST", "https://quocthinh.iristech.live/api/social/facebook/login_callback", false);
            //             req.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
            //             req.send(data);
            //             // Result
            //             console.log(req.response);
            //         }, {scope: 'pages_manage_metadata, pages_messaging', return_scopes: true, enable_profile_selector: true});
            //     }
            // });
        }
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
@endsection
