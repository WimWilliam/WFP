


    <div class="form-group">
        <label for="exampleInputType">Name of Type</label>
        <!-- Value={{$data->name}} = memberikan value di inputan-->
        <input type="text" class="form-control" id="eName" name="type_name" 
            aria-describedby="nameHelp" placeholder="Enter Name of Type..." value="{{$data->name}}">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of type here.</small>
    </div>
    
    <button type=“button" class="btn btn-primary" onclick="saveDataUpdateTD({{$data->id}})">Submit</button>


