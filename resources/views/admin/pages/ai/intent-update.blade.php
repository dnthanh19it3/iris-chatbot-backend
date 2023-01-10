@extends("admin.layouts.layout")
@section("title", trans("app.web.project.title"))
@section("body")
    <style>
        .custom-intent-input {
            background: transparent;
            border: none;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
        .custom-intent-input:before {
            content: "#";
        }
        .custom-intent-input:focus, .custom-intent-input:hover {
            background: transparent;
            border-bottom: 1px solid white;
            color: white;
            font-weight: 600;
            font-size: 18px;
            border-radius: 0px;
        }
    </style>
    <form method="post" action="{{ route("ai.intent.edit-post", ["id" => $intent->id]) }}" enctype="multipart/form-data" class="row">
        @csrf
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <div class="row d-flex justify-content-center align-content-center align-items-center">
                        <div class="col-md-11">
                            <input type="text" class="form-control form-control-navbar custom-intent-input" value="{{ $intent->tag }}">
                        </div>
                        <div class="col-md-1 d-flex justify-content-end">
                            <button class="btn btn-success btn-sm">Save</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 style="margin-bottom: 0px">Patterns</h5>
                            <small>Template text to help AI understand what they wanna say</small>
                            <hr/>
                        </div>
                    </div>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search by name">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i> </button>
                        </span>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="pattern-container">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-quote-left"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Add user expression" id="txt_pattern">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" id="btn_add_pattern" type="button"><i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                                <hr/>
                            </div>

                            <div id="pattern-container">
                                @foreach($intent->patterns as $item)
                                    <div class="input-group mb-3" id="pid-{{ $item->id }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-quote-left"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="pattern[old][{{ $item->id }}]" placeholder="Add user expression" value="{{ $item->pattern }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger" onclick="handleRemovePattern('{{ $item->id }}')"><i class="fa fa-trash-alt"></i> </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5 style="margin-bottom: 0px">Response</h5>
                                    <small>Text, response will be deliver to user. Use only one reponse to send exactly response to user </small>
                                    <hr/>
                                </div>
                            </div>
                            <div class="pattern-container">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-quote-left"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Add user expression" id="txt_response">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="button" id="addResponseBtn"><i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                                <hr/>
                            </div>

                            <div class="pattern-container" id="response-container">
                                @foreach($intent->responses as $item)
                                    <div class="input-group mb-3" id="rid-{{ $item->id }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-quote-left"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="response[old][{{ $item->id }}]" placeholder="Add response" value="{{ $item->response }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger" onclick="handleRemoveResponse('{{ $item->id }}')"><i class="fa fa-trash-alt"></i> </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Create</button>
                    <div class="float-right">
{{--                        {!! $intents->links() !!}--}}
                    </div>
                </div>

            </div>

        </div>

    </form>
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
    <script>
        // local helper
        function generateInputPattern(pattern){
            let uuid = generateUUID();
            let html = `
                                <div class="input-group mb-3" id="pid-${uuid}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-quote-left"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="pattern[new][]" placeholder="Add user expression" value="${pattern}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" onclick="handleRemovePattern('${uuid}')"><i class="fa fa-trash-alt"></i> </button>
                                    </div>
                                </div>
            `;
            return html;
        }

        function generateInputReponse(response){
            let uuid = generateUUID();
            let html = `
                                <div class="input-group mb-3" id="rid-${uuid}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-quote-right"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="response[new][]" placeholder="Add response" value="${response}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" onclick="handleRemoveResponse('${uuid}')"><i class="fa fa-trash-alt"></i> </button>
                                    </div>
                                </div>
            `;
            return html;
        }
        function generateUUID() { // Public Domain/MIT
            var d = new Date().getTime();//Timestamp
            var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now()*1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16;//random number between 0 and 16
                if(d > 0){//Use timestamp until depleted
                    r = (d + r)%16 | 0;
                    d = Math.floor(d/16);
                } else {//Use microseconds since page-load if supported
                    r = (d2 + r)%16 | 0;
                    d2 = Math.floor(d2/16);
                }
                return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
        }
        function htmlToElement(html) {
            var template = document.createElement('template');
            html = html.trim(); // Never return a text node of whitespace as the result
            template.innerHTML = html;
            return template.content.firstChild;
        }
        function handleRemovePattern(id){
            $("#pid-" + id).remove();
        }

        function handleRemoveResponse(id){
            $("#rid-" + id).remove();
        }
        // handle form action
        $(document).ready(() => {
            const btnAddPattern = $("#btn_add_pattern");
            const btnAddResponse = $("#addResponseBtn");
            const containerPattern = $("#pattern-container");
            const containerResponse = $("#response-container");
            const txtPattern = $("#txt_pattern");
            const txtResponse = $("#txt_response");
            btnAddPattern.click(function () {
                console.log(txtPattern.val());
                containerPattern.append(htmlToElement(generateInputPattern(txtPattern.val())));
            });

            btnAddResponse.click(function () {
                console.log(txtResponse.val());
                containerResponse.append(htmlToElement(generateInputReponse(txtResponse.val())));
            });
        })
    </script>
@endsection
