@extends('Admin.layout.app')
@section('content')
       <!--start content-->
       <main class="page-content">
              
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
          <div class="col">
            <div class="card radius-10">
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <div>
                          <p class="mb-0 text-secondary">Total ekstrakulikuler</p>
                          <h4 class="my-1">{{$totalExtra}}</h4>
                          <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> 5% from last week</p>
                      </div>
                      <div class="widget-icon-large bg-gradient-purple text-white ms-auto"><i class="bi bi-basket2-fill"></i>
                      </div>
                  </div>
              </div>
            </div>
           </div>
           <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Murid</p>
                            <h4 class="my-1">{{$totalStudents}}</h4>
                            <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> 4.6 from last week</p>
                        </div>
                        <div class="widget-icon-large bg-gradient-success text-white ms-auto"><i class="bi bi-currency-exchange"></i>
                        </div>
                    </div>
                </div>
            </div>
           </div>
           <div class="col">
            <div class="card radius-10">
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <div>
                          <p class="mb-0 text-secondary">Total Guru</p>
                          <h4 class="my-1">{{$totalTeachers}}</h4>
                          <p class="mb-0 font-13 text-danger"><i class="bi bi-caret-down-fill"></i> 2.7 from last week</p>
                      </div>
                      <div class="widget-icon-large bg-gradient-danger text-white ms-auto"><i class="bi bi-people-fill"></i>
                      </div>
                  </div>
              </div>
           </div>
           </div>
           <div class="col">
            <div class="card radius-10">
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <div>
                          <p class="mb-0 text-secondary">Total Jurusan</p>
                          <h4 class="my-1">{{$majors}}</h4>
                          <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> 12.2% from last week</p>
                      </div>
                      <div class="widget-icon-large bg-gradient-info text-white ms-auto"><i class="bi bi-bar-chart-line-fill"></i>
                      </div>
                  </div>
              </div>
            </div>
           </div>
        </div><!--end row-->


        

        
      </main>
   <!--end page main-->
  @endsection