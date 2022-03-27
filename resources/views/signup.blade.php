@extends("parent")
@section("title","SignUp")

@section("navbar")
    @parent
@stop

@section("addDetails")
<div class="container">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-7">
            <h3>{{__("lang.SignUp")}}</h3>
            <form action="/signUpNow" method="POST">

                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">{{__("lang.Username")}}</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="username">
                    <div id="username" class="form-text">{{__("lang.sloganUsername")}}</div>
                </div>             

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
        
                <button type="submit" class="btn btn-primary">{{__("lang.SignUp")}}</button>
                <div id="data"></div>

             

                <script>
                     var obj=@json($errors??"");
                     
                     var data=document.getElementById("data");
                     var keys = Object.keys(obj);
                     if(keys.length>0){
                        var details="";
                        for (var i = 0; i < keys.length; i++) {
                                
                                var val = obj[keys[i]];
                                details+=val+"<br>";
                            
                        }
                        data.innerHTML=`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" style="background-color:transparent;border:none;outline:none;" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Error Founded</strong> 
                            <br>
                            <span>${details}</span>
                        </div>`;
                     }

                     
                     
                </script>
          
            
            </form>
        </div>
    </div>
</div>
@endsection