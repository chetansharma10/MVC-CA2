@extends("parent")
@section("title","Login")

@section("navbar")
    @parent
@stop

@section("addDetails")
<div class="container">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-7">
            <h3>{{__("lang.Login")}}</h3>
            <form action="/logNow" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{__("lang.Email")}}</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">{{__("lang.sloganEmail")}}</div>
                </div>
            
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">{{__("lang.Password")}}</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelp">
                  <div id="passwordHelp" class="form-text">{{__("lang.sloganPassword")}}</div>
                </div>
                <div id="data"></div>

        
                
                <button type="submit" class="btn btn-primary">{{__("lang.Login")}}</button>
                <script>
                    var isVerified=@json($verified??false);
                    var errors=@json($errors??"");
                    console.log(errors);
                    var data=document.getElementById("data");
                    if(isVerified){
                        data.innerHTML=`
                        <div class="alert alert-success alert-dismissible auto-fade show" role="alert">
                            <button type="button" style="background-color:transparent;border:none;outline:none;" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Email is successfully verified,<br></strong>
                            Now Login to get access to homepage
                        </div>
                        `;
                        setTimeout(() => {
                            data.innerHTML="";
                        }, 2000);

                    }

                </script>
            </form>
        </div>
    </div>
</div>
@endsection