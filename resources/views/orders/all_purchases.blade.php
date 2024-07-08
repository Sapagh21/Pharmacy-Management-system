@include('subviews.header')
@if (session('msg'))
<div class="sys-message danger">
    {{session('msg')}}
</div>
@endif
<div class="container">
    <section class="search">
        <div class="container">
            <div class="form-control">
                <h1>Search</h1>
                <form method="get" action="{{route('PurchaseSearch')}}" class="SearchForm">
                <!-- id -->
                <label for="id"> ID:</label> 
                <input type="int" name="id" id="id" value="{{request('id')}}"> 
                <!--  name -->
                <label for="customer_name">Costumer Name:</label> 
                <input type="text" name="customer_name" id="customer_name" value="{{request('customer_name')}}"> 
                <!-- Phone -->
                <label for="phone">Phone:</label> 
                <input type="text" name="phone" id="phone" value="{{request('phone')}}"> 
                <!-- Submit button -->
                <button type="submit">Search</button>
                <a href="{{route('showallPurchase')}}">clear</a>

                </form>

            </div>
            
        </div>
    </section>

    <section class="all-purchases">
        <table>
            <tr>
                <th>ID</th>
                <th>Costumer Name</th>
                <th>Phone</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->id }}</td>
                <td>{{ $purchase->customer_name }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ $purchase->name }}</td>  {{--Drug name --}}
                <td>{{ $purchase->phone_number }}</td>
                <td>{{ $purchase->Total_price }}</td>
                <td><form method="POST" action="{{route('deletePurchase',['purchaseId'=>$purchase->id , 'prodId'=> $purchase->product_id] )}}">
                    @csrf
                    <button class="danger" value="submit">delete</button>
                </form>
            </td>
            </tr>
        @endforeach
    
        </table>
    </div>
        
    </section>

</body>
</html>