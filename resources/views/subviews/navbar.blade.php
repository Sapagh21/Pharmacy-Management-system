<nav>
    <div class="container">
        <ul>
            
            <li> <a href="{{route('home')}}"  @class( [ 'active'=> NamePage($_SERVER["PHP_SELF"]) =="Home"   ])> Home </a> </li>
            <li> <a href="{{route('showAllDrugs')}}" @class( [ 'active'=> NamePage($_SERVER["PHP_SELF"]) =="Drugs"   ])  > Drugs </a> </li>
            <li> <a href="{{route('showallPurchase')}}" @class( [ 'active'=> NamePage($_SERVER["PHP_SELF"]) =="Purchases"   ])  > Orders </a> </li>
            <li> <a href="{{route('showProfile')}}" @class( [ 'active'=> NamePage($_SERVER["PHP_SELF"]) =="Profile"   ])  > Profile </a> </li>

        </ul>
</div>
</nav>