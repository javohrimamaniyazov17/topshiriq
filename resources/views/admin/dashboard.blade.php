@extends('layouts.app')

@section('content')
    


<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
           <h1 class="m-0">Dashboard</h1>
         </div><!-- /.col -->
   
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <!-- Small boxes (Stat box) -->
       <div class="row">
         <div class="col-lg-3 col-12">
           <!-- small box -->
           <div class="small-box bg-info">
             <div class="inner">
               <h3>{{ count($users)}}</h3>

               <p style="font-size: 19px">Barcha Foydalanuvchilar</p>
             </div>
             <div class="icon">
               <i class="ion ion-person"></i>
             </div>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-12">
           <!-- small box -->
           <div class="small-box bg-success">
             <div class="inner">
               <h3>{{count($user)}}</h3>

               <p style="font-size: 19px">Adminlar</p>
             </div>
             <div class="icon">
               <i class="fas fa-user-cog"></i>
             </div>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-12">
           <!-- small box -->
           <div class="small-box bg-warning">
             <div class="inner">
               <h3>{{count($category)}}</h3>

               <p style="font-size: 19px">Barcha Kategoriyalar</p>
             </div>
             <div class="icon">
               <i class="ion ion-grid"></i>
             </div>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-12">
           <!-- small box -->
           <div class="small-box bg-danger">
             <div class="inner">
               <h3>{{ count($product)}}</h3>

               <p style="font-size: 19px">Barcha Mahsulotlar</p>
             </div>
             <div class="icon">
               <i class="nav-icon fas fa-shopping-cart"></i>
             </div>

           </div>
         </div>
         <!-- ./col -->
       </div>
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 @endsection
