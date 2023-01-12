@extends("admin.layouts.layout")
@section("title", "Training logs")
@section("body")
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Training logs and improve</h3>
                </div>
                <div class="card-body">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search by name">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i> </button>
                        </span>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-primary" role="alert">
                                Logs contain item which cant be define. If you want to detect it, you can easy to assign intent here
                                </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 60%">Content</th>
                                    <th style="min-width: 100px">Status</th>
                                    <th style="width: 30%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $log->content }}</td>
                                        <td>{{ $log->status }}</td>
                                        <td style="width: 30%">
                                            <form method="post" action="{{ route("ai.training.improve", ["log_id" => $log->id]) }}">
                                                @csrf
                                                <input type="hidden" value="{{ $log->content }}" name="pattern">
                                                <div class="input-group mb-3">
                                                    <select name="intent_id" class="form-control">
                                                        <option value="">Please select intent</option>
                                                        @foreach($intents as $intent)
                                                            <option value="{{ $intent->id }}">{{ $intent->tag }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fa fa-save"></i> Save</button>
                                                    </div>
                                                </div>
{{--                                                <select name="intent" class="form-control">--}}

{{--                                                </select>--}}
{{--                                                <button type="submit" class="btn btn-sm btn-primary"><i--}}
{{--                                                        class="fa fa-save"></i></button>--}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                </div>

            </div>

        </div>

    </div>
    <!--    --><?php //dd(session()); ?>
        <!-- Modal -->
    <div class="modal fade" id="linkingModal" tabindex="-1" role="dialog" aria-labelledby=linkingModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-search"></i> Chose page to linking
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formPage" enctype="multipart/form-data">
                        <h5>Congrate! You just authorize use to access your page. Let choose which page to linking with
                            our platform </h5>
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
                if (listPageResponse.data.length > 0) {
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
                    if (!Reflect.has(object, key)) {
                        object[key] = value;
                        return;
                    }
                    if (!Array.isArray(object[key])) {
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
