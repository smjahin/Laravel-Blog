@extends('welcome')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

        <a href="{{route('add.category')}}" class="btn btn-danger">Add Category</a>
        <a href="{{route('all.category')}}" class="btn btn-info">All Category</a>
        <a href="#" class="btn btn-info">All Post</a>
              <hr>

          <style media="screen">
          .at{
          border-radius: 5px;
          background: #84898E;
          }
          .a{
            background:#138496;
          }

          .b{
            background:#C82333;
          }

          .c{
            background:#138496;
          }
          </style>

        <div>
          <table class="table table_responsive at">
            <tr>
             <th class="a">Category Name</th>
             <th class="b">Slug Name</th>
             <th class="c">Created At</th>
           </tr>
           <tr>
             <td> {{$category->name}} </td>
             <td> {{$category->name}} </td>
             <td> {{$category->created_at}} </td>
           </tr>

        </table>

        </div>
        </div>
      </div>
    </div>
  @endsection
