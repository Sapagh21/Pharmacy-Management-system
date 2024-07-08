    @include('subviews/header')
    <section class="search">
        <div class="container">
            <div class="form-control">
                <h1>Search</h1>
                <form method="get" action="{{route('DrugsSearch')}}" class="SearchForm">
                <!-- id -->
                <div class="">
                    <label for="id"> ID:</label> 
                    <input type="int" name="id" id="id" value="{{request('id')}}"> 
                </div>
                <!--  name -->
                <div class="">
                    <label for="name">Drug Name:</label> 
                    <input type="text" name="name" id="name" value="{{request('name') ?? request('headSearch')}}"> 
                </div>
                
                <div class="buttons">
                <!-- search button -->
                    <button id="drugSearch" type="submit">Search</button>
                    <button id="drugSearch" name="showall" value='1' >Show all</button>
                    <a href="{{route('showAllDrugs')}}">clear</a>
                </div>
                </form>
    
            </div>
            
        </div>
    </section>

<div class="container">
    <section class="all-purchases">
        @if (request('showall'))
            <table id="table">
                <tr>
                    <th>ID</th>
                    <th>Drug Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>price</th>
                    <th>Expiry date</th>
                    <th>Prescription Required </th>
                    <th colspan="3"> Action </th>
                    
                </tr>

                @foreach($drugs as $drug)
                <tr>
                    <td>{{ $drug->id }}</td>
                    <td>{{ $drug->name }}</td>
                    <td>{{ $drug->description }}</td>
                    <td>{{ $drug->quantity }}</td>
                    <td>{{ $drug->price }}</td>
                    <td>{{ $drug->Expiry_date }}</td>
                    <td>{{ $drug->prescription_required ? "Yes" :"No"  }}</td>
                    <td>
                        <form method="POST" action="{{route('deleteDrug',['id'=>$drug->id])}}">
                            @csrf
                            <button class="Actionbtn" value="submit">delete</button>
                        </form>
                    </td>
                    <td class="Actionbtn" ><a href="{{route('showUpdateDrug',['id'=>$drug->id])}}">update</a> </td>
                    <td class="Actionbtn"><a href="{{route('showDrug',['id'=>$drug->id , 'name'=>$drug->name])}}">Show</a></td>
                </tr>
            @endforeach
        
            </table>

        @else
            @if (request('name') !== null || request('id')!== null)


                @if ($drugs == null)
                    <span> No result Found</span>
                @else
                    <table id="table">
                        <tr>
                            <th>ID</th>
                            <th>Drug Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>price</th>
                            <th>Expiry date</th>
                            <th>Prescription Required </th>
                            <th colspan="3"> Action </th>
                            
                        </tr>
            
                        @foreach($drugs as $drug)
                            <tr>
                                <td>{{ $drug->id }}</td>
                                <td>{{ $drug->name }}</td>
                                <td>{{ $drug->description }}</td>
                                <td>{{ $drug->quantity }}</td>
                                <td>{{ $drug->price }}</td>
                                <td>{{ $drug->Expiry_date }}</td>
                                <td>{{ $drug->prescription_required ? "Yes" :"No"  }}</td>
                                <td>
                                    <form method="POST" action="{{route('deleteDrug',['id'=>$drug->id])}}">
                                        @csrf
                                        <button class="Actionbtn" value="submit">delete</button>
                                    </form>
                                </td>
                                <td class="Actionbtn" ><a href="{{route('showUpdateDrug',['id'=>$drug->id])}}">update</a> </td>
                                <td class="Actionbtn"><a href="{{route('showDrug',['id'=>$drug->id , 'name'=>$drug->name])}}">Show</a></td>
                            </tr>
                        @endforeach
                
                    </table>

                    {{-- <div class="buttons">
                        <a href="{{route('showAddDrug')}}"><button> Add New Drug</button></a>
                    </div> --}}
                        
                @endif
                
            @endif
        @endif
    </section>
</div>

</body>
</html>