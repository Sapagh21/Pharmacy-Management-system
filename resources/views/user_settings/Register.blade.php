@include('subviews.header')
@if (session('msg'))
        <div class="sys-message danger">
             {{session('msg')}} 
        </div>
@endif

<div class="container">

    <form action="{{route('handleRegister')}}" class="DataForm" method="post" >
        @csrf
        <div class="">
            <label for="name">Full Name</label> 
            <input  type="text" name="name" id="name" required> 
        </div>
        
        <div class="">
            <label for="  username">Username</label> 
            <input type="text" name="  username" id="  username" required> 
        </div>
        
        <div class="">
            <label for="password">Password</label> 
            <input type="password" name="password" id="password"> 
        </div>
        
        <div class="">
            <label for="cpassword">Confirm Password</label> 
            <input type="password" name="cpassword" id="cpassword" > 
        </div>
        
        <!--submitt button-->
         <div class="buttons">
            <button type="submit" >Register</button>
        </div>

    </form>


</div>