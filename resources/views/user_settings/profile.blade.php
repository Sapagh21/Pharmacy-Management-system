@include('subviews.header')
@if (session('msg'))
        <div class="sys-message ">
             {{session('msg')}} 
        </div>
@endif

<div class="container">
    <section class="user-settings">

        <div class="user-info">
            {{-- in case file can't be found image won't be shown and the default image will be shown instead --}}
            @php 
            $imgPath = "imgs/AppData/staff/".session('pfp');
           @endphp

            {{-- Delete image button --}}
            @if (is_file($imgPath))
                <div class="deleteimg">
                    <label for="deleteImg" > <i class="fa-solid fa-trash"></i></label>
                    <a class="show-later"  id="deleteImg"  href="{{route('deleteImg')}}"> asdasd  </a>
                </div>
            @endif
            {{-- User  profile picture --}}
            <div class="user-img">
                <div class="default-img"></div>
                

                @if (is_file($imgPath) )
                    <img class="userPfp" src="{{asset("$imgPath")}}" alt="">
                @endif

            </div> 
            
            <div class="name">
                <h2 class="user-name"> {{session('Name')}} </h2>
                <p class="user-type" > {{strtoupper( session('user_type')  )}} </p>
            </div>

        </div>

    {{-- Manage which form shows --}}
        <ul class="management"> 

            <li> <a href="" class="show-modify personal" > Change Personal Information </a> </li>
            <li> <a href="" class="show-modify username" > Change Username </a> </li>
            <li> <a href="" class="show-modify password" > Change Password </a> </li>
            
            @if (session('user_type') == 'Owner')
            <li><a href="{{route('showAllStaff')}}">Manage Staff</a></li>
            @endif
        </ul>
    </section>


    <section class="modify_personal   ">

        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
                {{--! Personal info --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------------- --}}

        <form action="{{route('updateProfile')}}" method="POST"  enctype="multipart/form-data" @class(['change-personal', 'show-later', 'visible'=>session('visibleSection')=='personal'  ])>
            @csrf

            <input type="hidden" name="type" value="personal">
            <div class="change-img">
                
                <label for="img"> Upload image</label>
                <input type="file" id="img" name="pfpimg" >
                
                
            </div>



            <div class="change-name">
                <label for="fname"> Full Name</label>
                <input type="text" value="{{ old('fname') ?? session('Name')}}"  id ="fname" name="fname" >
            </div>

            <div class="change-pass">
                <label for="pass"> Enter Password</label>
                <input type="password"    name="pass" >
            </div>

            <span class="error"> {{session('error')}}  </span>
            <button type="submit"> Apply Changes</button>
        </form>




        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
                                    {{--! Change Username --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
        
        <form action =" {{route('updateProfile')}}" method="POST" @class(['change-username', 'show-later', 'visible' => session("visibleSection") == "username"  ]) >
            @csrf
            
            <input type="hidden" name="type" value="username">

            <div class="change-username">
                <label for="username"> Username</label>
                <input type="text" value="{{session('user')}}" id="username"  name="usern" >
            </div>


            <div class="change-pass">
                <label for="pass"> Enter Password</label>
                <input type="password"  id = "pass"  name="pass" >
            </div>

            <span class="error"> {{session('error')}}  </span>
            <button type="submit"> Apply Changes</button>
        </form>


        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
                {{--! Change Password --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- ----------------------------------------------------------------------------------------- --}}


        <form action =" {{route('updateProfile')}}" method="POST" @class(['change-password', 'show-later' , 'visible'=>session('visibleSection')=='password'  ]) >
            @csrf

            <input type="hidden" name="type" value="password">

            <div class="change-pass">
                <label for="pass"> Enter New Password</label>
                <input type="password"  name="newPass" >
            </div>

            
            <div class="change-pass">
                <label for="pass"> Confirm New Password</label>
                <input type="password"  name="confirmNewPass" >
            </div>

            <div class="change-pass">
                <label for="pass"> Enter old Password</label>
                <input type="password"   name="pass" >
            </div>

            <span class="error"> {{session('error')}}  </span>
            <button type="submit" > Apply Changes</button>
        </form>
    </section>

</div>



<script>

// Select all links and sections    
    let links = document.querySelectorAll('.management .show-modify');
    let sections = document.querySelectorAll('.modify_personal form');

// hide/show sections
    function hideShowSection (link , section){

        link.addEventListener( 'click',  function(e){
            e.preventDefault(); // only because im using <a> tag otherwise it's useless

        // Hide all sections except the one clicked on
            sections.forEach(othersection =>{
                if(othersection != section){
                    othersection.classList.add('show-later');
                    othersection.classList.remove('visible');
                }
            });

        // Toggle the visibility of the clicked section
            section.classList.toggle('show-later');


        });
    }
    
    // Attach the event listener to each link and it's corrsponding section 
    // Note : Sections has to be in the same order as the links
    for(let i = 0 ; i<links.length ; i++){
        hideShowSection(links[i] , sections[i]);
    }


    // Hide the Default image when an image is uploaded ---
    const imgageContainer = document.querySelector('.user-info .user-img');
    const pfp = document.querySelector('img.userPfp');
    const defaul = document.querySelector('.default-img')
    
    if(imgageContainer.contains(pfp)){
        defaul.classList.add('hide');
    }else{
        defaul.classList.remove('hide');
    }


    // To make the label trigger the Anchor
     
    const deleteLabel = document.querySelector('label[for="deleteImg"]');
    const deleteAnchor = document.querySelector('#deleteImg');
    deleteLabel.addEventListener('click' , function(e){
        deleteAnchor.click();
    });

</script>




