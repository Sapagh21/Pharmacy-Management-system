@include('subviews.header')
<div class="container">
@if (session('accessError'))
<div class="PageError">
    <img src="{{asset('imgs/Not Authorized.png')}}" alt="">
    <span> <span class="error"> Access Error!</span>
           You are not Authorized To Enter that page...    </span>
    </div>
@else
<img class="PnotFound" src="{{asset('imgs/notFound.png')}}" alt="">

@endif



</div>
<style>
    img{
        width: 55%;
        height: auto;
        margin: auto;
    }

    .container{
        user-select: none;
    }

   .PageError{
        width: 60% ;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
   }
   .PageError span{
        font-size: 50px;
        text-align: center;
        width: 150%;
        font-weight: bold;
        white-space:pre-line ;
    }
</style>

<script>
    function prind(){
        window.print();
    }
    let img  = document.querySelector('img');
    img.addEventListener('contextmenu' ,  function(e) {
        e.preventDefault();
    });

    img.addEventListener('dragstart' ,  function(e) {
        e.preventDefault();
    });

</script>