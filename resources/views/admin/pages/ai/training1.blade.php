@extends("admin.layouts.layout")
@section("title", "Training")
@section("body")
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Manage training process</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Server status</h3>
                                </div>
                                <div class="card-body" style="min-height: 90px">
                                    <i id="serverStatusIcon" class="fa fa-dot-circle mr-3"></i><span id="serverStatus">Checking</span>
                                </div>
                                <div id="serverStatusOverlay" class="overlay dark">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Training status</h3>
                                </div>
                                <div class="card-body" style="min-height: 90px">
                                    <div>
                                        <i class="fa fa-dot-circle text-success mr-3"></i><span>Running</span>
                                    </div>
                                    <div><code>Update dataset 2 mins ago, Not trained</code></div>
                                </div>
{{--                                                                <div class="overlay dark">--}}
{{--                                                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>--}}
{{--                                                                </div>--}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Loading state (dark)</h3>
                                </div>
                                <div class="card-body">
                                    The body of the card
                                </div>
                                <div class="overlay dark">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-gradient-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Loading state (dark)</h3>
                                </div>
                                <div class="card-body">
                                    The body of the card
                                </div>
                                <div class="overlay dark">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
{{--                    <a href="{{ route("ai.intent.create") }}" class="btn btn-info">Create</a>--}}
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
    <script type="text/javascript">
        let baseUrl = "http://127.0.0.1:5000/";
        $(document).ready(function () {
            $("#btninit").click(function () {
                console.log("Init clicked");
            });
            checkServerStatus();
            fetchTrainingStatus();
            function checkServerStatus() {
                $.ajax({
                    type: "GET",
                    url: baseUrl,
                    async: true,
                    success: function (result) {
                        $("#serverStatusOverlay").show();
                        let request_result = JSON.parse(result);
                        if(request_result.status == 0){
                            $("#serverStatus").text("Running");
                            $("#serverStatusIcon").addClass("text-success");
                            $("#serverStatusOverlay").hide();
                        } else {
                            $("#serverStatus").text("Cant connect");
                            $("#serverStatusIcon").addClass("text-danger");
                            $("#serverStatusOverlay").hide();
                        }
                    }
                });
            }
            function fetchTrainingStatus(){
                console.log("Check Train");
                let checkingUrl = "{{ "BULLSHIT" }}";
                $("#status_train").text("Đang khởi chạy");
                $.ajax({
                    type: "GET",
                    url: checkingUrl,
                    async: true,
                    success: function (result) {
                       console.log(result);
                    }
                });
            }
            function train(){
                console.log("Train");
                let train_url = baseUrl + "train_app/" + {{ $project->id }};
                let checkingUrl = "{{ route("ai.training.check-training") }}";
                $("#status_train").text("Đang khởi chạy");
                $.ajax({
                    type: "GET",
                    url: train_url,
                    async: true,
                    success: function (result) {
                        let request_result = JSON.parse(result);
                        if(request_result.status == 1){
                            $("#status_train").text(request_result.message);
                            init();
                        } else {
                            $("#status_train").text(request_result.message);
                        }
                    }
                });
            }
        });
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
@endsection
