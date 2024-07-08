@include('subviews.header')
@if (session('error'))
    <div class="sys-message danger">
        {{session('error')}}
    </div>
@endif

<h1>New purchase</h1>
<section class="purchase">
    <div class="container">
        <div class="form-control">
            <!--form for making purchase-->
            <form method="post" action="{{route("handlePurchase")}}" class="DataForm">
                @csrf
                
                <div class="form-group">
                    <label for="costumer_name">Costumer Name:</label>
                    <input type="text" name="costumer_name" id="costumer_name">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone">
                </div>
                
                <div class="form-group">
                    <label for="product">Product:</label>
                    <select type="text" name="product" id="product">
                        <option value="">Select a drug</option>
                        @foreach ($products as $prod)
                        <option value="{{$prod->id}}">{{$prod->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity">
                </div>
                
                <!-- Submit button goes here -->
                
                <button type="submit" >Make Purchase</button>
            </form>
        </div>
        <a href="{{route('showallPurchase')}}"><button>All Purchases</button></a>
    </div>
</section>

</body>
</html>