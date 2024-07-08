    @include('subviews/header')
    <h1>Update Drug</h1>
    <section class="Add-drug">
        <div class="container">
            <div class="DataForm">
                <!--form for updating drug-->
                <form method="POST" action="{{route('handleUpdateDrug',['id'=>$drugs->id])}}" class="DataForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Drug Name:</label>  
                        <input type="text" name="name" id="name" value="{{$drugs->name}}">  
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description:</label>  
                        <input type="text" name="description" id="description" value="{{$drugs->description}}">  
                    </div>
                    
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>  
                        <input type="number" name="quantity" id="quantity" value="{{$drugs->quantity}}">  
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price:</label>  
                        <input type="number" name="price" id="price" value="{{$drugs->price}}">  
                    </div>
                    
                    <div class="form-group">
                        <label for="Expiry_date">Expiry Date:</label>  
                        <input type="date" name="Expiry_date" id="Expiry_date" value="{{$drugs->Expiry_date}}">  
                    </div>
                    
                    <div class="form-group">
                        <label for="prescription_required">Prescription Required:</label>  
                        <select name="prescription_required" id="prescription_required">
                            <option value="{{$drugs->prescription_required}}">{{$drugs->prescription_required? "Yes" : "No"}}</option>
                            @php
                                if ($drugs->prescription_required == 0) {
                                    $Value = 1;
                                    $option = "Yes";
                                }else{
                                    $Value = 0;
                                    $option = "No";
                                }
                            @endphp
                            <option value="{{$Value}}">{{$option}}</option>
                        </select>
                    </div>
                    

                    <!-- Update button goes here -->
                    
                    <button type="submit" >Update Drug</button>
    
    
                </form>
            </div>
        </div>
    </section>
   
</body>
</html>