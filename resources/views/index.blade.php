@extends('layouts.app')
 
 @section('content')
    <div class="panel-heading">Проходы</div>
     <div class="container">
         <div class="row">
             <div class="col-md-8 col-md-offset-2">
                 <div class="panel panel-default">
                     <div class="panel-heading">Проходы</div>
  
                     <div class="panel-body table-responsive">
                        <router-view name="staffIndex"></router-view>
                        <router-view></router-view>
                        <div class="form-group">
                            <!-- <router-link :to="{name: 'staffIndex'}" class="btn btn-success">Список пользователей</router-link> -->
                        </div>
                    </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection