@extends("admin.layouts.layout")
@section("title", trans("app.web.project.title"))
@section("body")
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Horizontal Form</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route("user.project.create.post") }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Project name">
                                @error('name')
                                <div class="text-red">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="description" id="description" placeholder="Describe about project">
                                @error('description')
                                <div class="text-red">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Create</button>
                        <a href="{{ route("user.project.index") }}" class="btn btn-default float-right">Cancel</a>
                    </div>

                </form>
            </div>

        </div>

    </div>
<!--    --><?php //dd(session()); ?>
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
                   <form id="formPage" enctype="multipart/form-data">
                       <h5>Congrate! You just authorize use to access your page. Let choose which page to linking with our platform  </h5>
                       <div class="form-group" id="listPageDiv">

                       </div>
                       <input type="hidden" id="userID" name="userID">
                       <input type="hidden" id="accessToken" name="accessToken">
                       <input type="hidden" id="integration_id" name="integration_id" value="{{ "MIGRATION_ID" }}">
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitPageBtn">Confirm</button>
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
                               <input class="form-check-input" type="checkbox" name="pageID" value="${item.id}_${item.access_token}">
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
        $(document).ready(function () {
            $("#submitPageBtn").click(function () {
                var form = document.querySelector('#formPage');
                var data = new FormData(form);
                var object = {};
                data.forEach((value, key) => {
                    // Reflect.has in favor of: object.hasOwnProperty(key)
                    if(!Reflect.has(object, key)){
                        object[key] = value;
                        return;
                    }
                    if(!Array.isArray(object[key])){
                        object[key] = [object[key]];
                    }
                    object[key].push(value);
                });
                var json = JSON.stringify(object);
                console.log(json);
                let req = new XMLHttpRequest();
                req.open("POST", "https://quocthinh.iristech.live/api/social/facebook/page_verify", false);
                req.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                req.send(json);
                console.log(data.response);
            });
        });
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
@endsection
