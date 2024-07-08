@include('subviews.header')
<div class="container">
    <h1> Owners </h1>
    <div class="staff">  
        @foreach ( $owners as $owner )
        <div class="user-info">
            {{-- in case file can't be found image won't be shown and the default image will be shown instead --}}
            @php 
            $imgPath = "imgs/AppData/staff/".$owner->Picture;
            @endphp

                    {{-- User  profile picture --}}
            <div class="user-img">
                <div class="default-img"></div>
                

                @if (is_file($imgPath) )
                    <img class="userPfp" src="{{asset("$imgPath")}}" alt="">
                @endif

            </div> 
            
            <div class="name">
                <h2 class="user-name"> {{$owner->FullName}} </h2>
            </div>

        </div>

        @endforeach

    </div>

    <hr style="margin: 20px 0 ">

    {{-- ------------------------------------------------------------------------------------- --}}
    {{-- ------------------------------------------------------------------------------------- --}}
    {{-- ------------------------------------------------------------------------------------- --}}
    <div class="staff-pharma">
    <h2> Pharmacists </h2>
    <a class="staff-add" href="{{route('Register')}}">+</a>
    <form action="{{route('staffSearch')}}" method="post" class="SearchForm">
        @csrf
        <select name="choice" id="">
            <option value="name">Name</option>
            <option value="username"> username</option>
        </select>
        <input type="search" name="pharmacistName" placeholder="Search for a pharmacist" id="">
    </form>
    </div>

    @if (session('searchresult'))
        <h2>Search Results!</h2>
        <div class="staff searchres">
            @foreach (session('pharmacists') as $pharmacist)
                <div class="user-info">
                    {{-- in case file can't be found image won't be shown and the default image will be shown instead --}}
                    @php 
                        $imgPath = "imgs/AppData/staff/".$pharmacist->Picture;
                    @endphp

                    
                    {{-- User  profile picture --}}
                    <div class="user-img">
                        <div class="default-img"></div>
                        
            
                        @if (is_file($imgPath) )
                            <img class="userPfp" src="{{asset("$imgPath")}}" alt="">
                        @endif
            
                    </div> 
                    
                    <div class="name">
                        <h2 class="user-name"> {{$pharmacist->FullName}} </h2>
                    </div>

                    <form action="{{route('staffDelete')}}" method="post" class="staffDeleteForm" >
                        @csrf
                        <input type="hidden" name="id" value="{{$pharmacist->ID}}" >
                        <button type="submit"> <label class="deleteStaff" > <i class="fa-solid fa-trash"></i></label> </button>
                    </form>

            
                </div>        
            @endforeach
        </div>
    @endif

    <div class="staff">
        @foreach ( $pharmacists as $pharmacist )
        <div class="user-info">
            {{-- in case file can't be found image won't be shown and the default image will be shown instead --}}
            @php 
                $imgPath = "imgs/AppData/staff/".$pharmacist->Picture;
            @endphp

            
            {{-- User  profile picture --}}
            <div class="user-img">
                <div class="default-img"></div>
                

                @if (is_file($imgPath) )
                    <img class="userPfp" src="{{asset("$imgPath")}}" alt="">
                @endif

            </div> 
            
            <div class="name">
                <h2 class="user-name"> {{$pharmacist->FullName}} </h2>
            </div>

            <form action="{{route('staffDelete')}}" method="post" class="staffDeleteForm" >
                @csrf
                <input type="hidden" name="id" value="{{$pharmacist->ID}}" >
                <button type="submit"> <label class="deleteStaff" > <i class="fa-solid fa-trash"></i></label> </button>
            </form>
        </div>
        @endforeach

    </div>

</div>