    @include('subviews/header')
    <div class="container">
        <div class="showdrug">
            <h1>{{ $drugs->name }}</h1>
            <div class="singledruginfo">
                <p>Description: {{ $drugs->description }}</p>
                <p>Quantity: {{ $drugs->quantity }}</p>
                <p>Price: {{ $drugs->price }}</p>
                <p>Expiry Date: {{ $drugs->Expiry_date }}</p>
                <p>Prescription Required: {{ $drugs->prescription_required ? "Yes" :"No" }}</p>
            </div>
            <div class="buttons">
                <a href="{{route('showUpdateDrug',['id'=>$drugs->id])}}"><button>update</button></a> 
                <form method="POST" action="{{route('deleteDrug',['id'=>$drugs->id])}}">
                    @csrf
                    <button class="danger" value="submit">delete</button>
                </form>

            </div>
        
        </div>
    </div>

</body>
</html>