    @include('subviews/header')
    
    <h1>Add a Drug</h1>
    <section class="add-drug">
        <div class="container">
            <div class="form-control">
                <!--form for adding drug-->
                <form method="POST" action="{{route('handleAddDrug')}}"  class="DataForm" >
                    @csrf
                    <!--drugs name input-->
                    <div class="drugname">
                        <label for="name">Drug Name:</label> 
                        <input  type="text" name="name" id="name" required> 
                    </div>
                    
                    <div class="description">
                        <label for="description">Description:</label> 
                        <input type="text" name="description" id="description"> 
                    </div>
                    
                    <div class="quantity">
                        <label for="quantity">Quantity:</label> 
                        <input type="number" name="quantity" id="quantity" required > 
                    </div>
                    
                    <div class="price">
                        <label for="price">Price:</label> 
                        <input type="number" name="price" id="price" required> 
                    </div>
                    
                    <div class="expiry-date">
                        <label for="Expiry_date">Expiry Date:</label> 
                        <input type="date" name="Expiry_date" id="Expiry_date"> 
                    </div>
                    
                    <div class="prescription-required">
                        <label for="prescription_required">Prescription Required:</label> 
                        <select name="prescription_required" id="prescription_required">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    
                     <!--submitt button-->
                     <div class="buttons">
                        <button type="submit" >Add Drug</button>
                    </div>
    
                </form>
            </div>
            <a href="{{route('showAllDrugs')}}"><button> All Drugs</button></a>

        </div>
    </section>
    
</body>
</html>