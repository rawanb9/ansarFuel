@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="row h-100 align-items-center align-content-center justify-content-center">
        <!-- ,km -->
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
        <!-- search input -->
        
        <!-- result table -->
            <div class="result-cont my-3 mx-2">
            @if(isset($details))
                <p> The Search results for your query <b> {{ $query }} </b> 
                <table class="table table-hover"  style="background-color: white;">
                    <tbody>
                        <th scope="row">provider</th>
                        <td>provider</td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">amount</th>
                        <td>provider</td>
                        </tr>
                        </tr>
                        <tr>
                        <th scope="row">fill date</th>
                        <td>provider</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p> The Search retest test test uery </p> 
                
            @endif
            </div>
        </div>
    </div>
@endsection
