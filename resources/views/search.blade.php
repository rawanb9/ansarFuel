@extends('layouts.layout')
@section('content')
<!-- style="background-color: green;" -->
    <div class="container">
        <div class="row align-items-center align-content-center justify-content-center">
        <!-- search input -->
        <div class="card my-4 mx-2">
        <h5 class="card-header">Search</h5>
        <form class="card-body" action="/search" method="GET" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." name="q">
                <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
            </div>
        </form>
        </div>
        
       
        <!-- result table -->
            <div class="result-cont my-3 mx-2">
                <p  style="color: white;"> The Search results for your query <b> {{ $key }} </b> 
                @foreach($car_infos as $car_info)
                <table class="table table-hover"  style="background-color: white;">
                    <tbody>
                        <th scope="row">name</th>
                        <td>{{$car_info->name}}</td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">fuel type</th>
                        <td>{{$car_info->fuel_type}}</td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">car type</th>
                        <td>{{$car_info->car_type}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                
                @foreach($car_fuels as $car_fuel)
                @if($car_fuel->fill_date =='') 
                <table class="table table-hover"  style="background-color: white;">
                    <tbody>
                    <form method="post" action="{{route('serial.store')}}">
                    @csrf
                        <th scope="row">provider</th>
                        <td>
                            <select name="provider">
                                <option value ="الهادي منصور"> 
                                    الهادي منصور
                                </option>
                                <option value ="ابو كرم فياض"> 
                                    ابو كرم فياض
                                </option>
                                <option value ="فايز قبيسي"> 
                                فايز قبيسي                               
                                </option>
                                <option value ="محمد محمود عاصي"> 
                                محمد محمود عاصي                               
                                </option>
                                <option value ="رشاد عاصي"> 
                                رشاد عاصي                              
                                </option>
                                <option value ="بلال الشيخ علي"> 
                                بلال الشيخ علي                              
                                </option>
                                <option value ="فارس"> 
                                فارس                              
                                </option>
                                <option value ="خالد فياض"> 
                                خالد فياض                              
                                </option>
                                <option value ="عون"> 
                                عون                              
                                </option>

                            </select>
                        </td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">amount</th>
                        <td><input type="text" name="amount" value="{{$car_fuel->provider_Id}}"></td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">fill date</th>
                        <td><button class="btn btn-secondary" type="submit">Fill</button></td>
                        </tr>
                        <input type='hidden' name='car_id' value="{{$car_info->id}}">
                    </form>
                    </tbody>
                </table>
                @else
                <table class="table table-hover"  style="background-color: white;">
                    <tbody>
                        <th scope="row">provider</th>
                        <td>{{$car_fuel->provider}}</td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">amount</th>
                        <td>{{$car_fuel->scheduled_amount}}</td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">fill date</th>
                        <td>{{$car_fuel->fill_date}}</td>
                        </tr>
                    </tbody>
                </table>
               

                @endif
                @endforeach

                
                
                
                <p> The Search retest test test uery </p> 
                
            </div>
        </div>
    </div>
@endsection
