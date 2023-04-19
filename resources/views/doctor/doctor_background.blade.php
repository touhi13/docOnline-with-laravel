@extends('layouts.doctor')
@section('title')
{{Auth::user()->name}} - Eduction
@endsection
@section('contant')
<div class="col-md-7 col-lg-8 col-xl-9">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}  <img src="images/{{ Session::get('image') }}" height="50"></strong>
    </div>
   
    @endif
  
    <div class="mt-5 bg-secondary p-2">
        <h5>Eduction</h5>        
        <table id="example" class="display table " style="width:100%">
    
            <thead>
            <tr>
                <th>Id</th>           
                <th>Degree</th>
                <th>Institute</th>
                <th>Completion</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($education as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->degree}}</td>
                <td>{{$v->institute}}</td>
                <td>{{$v->completion}}</td>
              
            </tr>
            @endforeach
            
        </tbody>
        </table>
    </div>
    <div class="mt-5 bg-secondary p-2">
        <h5>Experience</h5>
        <table id="example" class="display table " style="width:100%">
    
            <thead>
            <tr>
                <th>Id</th>           
                <th>Hospital Name</th>
                <th>Designation</th>
                <th>Serve</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($exprience as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->hospitalName}}</td>
                <td>{{$v->designation}}</td>
                <td>{{$v->from}}-{{$v->to}}</td>
              
            </tr>
            @empty
            <tr>
                <td colspan="3">No Data</td></tr>  
            @endforelse
           
           
           
            
        </tbody>
        </table>
    </div>
    <div class="mt-5 bg-secondary p-2">
        <h5>Awards</h5>
        <table id="example" class="display table " style="width:100%">
    
            <thead>
            <tr>
                <th>Id</th>           
                <th>Award Name</th>
                <th>Year</th>            
                
            </tr>
        </thead>
        <tbody>
            @forelse ($award as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->awards}}</td>
                <td>{{$v->year}}</td>
            
              
            </tr>  
            @empty
            <tr>
                  <td colspan="3">No Data</td>
            </tr>  
            @endforelse
            
            
        </tbody>
        </table>
    </div>
    <div class="mt-5 mb-2 bg-secondary p-2">
        <h5>Registrations</h5>
        <table id="example" class="display table" style="width:100%">
    
            <thead>
            <tr>
                <th>Id</th>           
                <th>Registration</th>
                <th>Year</th>
              
                
            </tr>
        </thead>
        <tbody>
            @foreach ($registration as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->registrations}}</td>
                <td>{{$v->year}}</td>          
              
            </tr>
            @endforeach
            
        </tbody>
        </table>
    </div>
</div>
@endsection