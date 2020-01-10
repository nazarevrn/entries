@extends('layouts.app')
 
 @section('content')
    <div class="panel-heading"></div>
     <div class="container">
         <div class="row">
             <div class="col-md-8 col-md-offset-2">
                 <div class="panel panel-default">  
                     <div class="panel-body table-responsive">
                        <router-view name="staffIndex"></router-view>
                        <router-view></router-view>
                        <div class="form-group">
                            <router-link :to="{name: 'staffIndex'}" class="btn btn-success">Список пользователей</router-link>
                            <router-link :to="{name: 'entriesIndex'}" class="btn btn-success">Список посещений</router-link>
                        </div>
                    </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection