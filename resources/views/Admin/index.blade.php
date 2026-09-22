@extends('Admin.layout.app')
@section('content')
       <!--start content-->
       <main class="page-content">
              
        <!-- Row 1: Ekstrakurikuler, Siswa/Murid, Guru, Jurusan -->
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
          <div class="col">
            <div class="card radius-10">
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <div>
                          <p class="mb-0 text-secondary">Total Ekstrakurikuler</p>
                          <h4 class="my-1">{{$totalExtra}}</h4>
                      </div>
                      <div class="widget-icon-large bg-gradient-purple text-white ms-auto"><i class="bi bi-star-fill"></i>
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
                        </div>
                        <div class="widget-icon-large bg-gradient-success text-white ms-auto"><i class="bi bi-people-fill"></i>
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
                      </div>
                      <div class="widget-icon-large bg-gradient-danger text-white ms-auto"><i class="bi bi-person-badge-fill"></i>
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
                      </div>
                      <div class="widget-icon-large bg-gradient-info text-white ms-auto"><i class="bi bi-book-fill"></i>
                      </div>
                  </div>
              </div>
            </div>
           </div>
        </div><!--end row 1-->

        <!-- Row 2: Berita, Kategori Berita, Galeri, Pengguna / Admin -->
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
          <div class="col">
            <div class="card radius-10">
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <div>
                          <p class="mb-0 text-secondary">Total Berita</p>
                          <h4 class="my-1">{{$totalNews}}</h4>
                      </div>
                      <div class="widget-icon-large bg-gradient-warning text-white ms-auto"><i class="bi bi-newspaper"></i>
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
                            <p class="mb-0 text-secondary">Total Kategori Berita</p>
                            <h4 class="my-1">{{$totalCategories}}</h4>
                        </div>
                        <div class="widget-icon-large bg-gradient-royal text-white ms-auto"><i class="bi bi-tags-fill"></i>
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
                          <p class="mb-0 text-secondary">Total Galeri</p>
                          <h4 class="my-1">{{$totalGalleries}}</h4>
                      </div>
                      <div class="widget-icon-large bg-gradient-voilet text-white ms-auto"><i class="bi bi-images"></i>
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
                          <p class="mb-0 text-secondary">Pengguna / Admin</p>
                          <h4 class="my-1">{{$totalUsers}}</h4>
                      </div>
                      <div class="widget-icon-large bg-gradient-primary text-white ms-auto"><i class="bi bi-person-circle"></i>
                      </div>
                  </div>
              </div>
            </div>
           </div>
        </div><!--end row 2-->

      </main>
   <!--end page main-->
  @endsection