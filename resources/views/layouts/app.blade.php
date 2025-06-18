<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');

      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
    }

    function toggleDropdown() {
      const dropdown = document.getElementById('master-data-menu');
      dropdown.classList.toggle('hidden');
    }
  </script>
</head>
<body class="bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 font-sans h-screen overflow-hidden">

  <!-- Overlay for mobile when sidebar is open -->
  <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden lg:hidden" onclick="toggleSidebar()"></div>

  <!-- Mobile Top Bar -->
  <div class="lg:hidden flex items-center bg-purple-600 text-white p-4 fixed w-full z-30">
    <button onclick="toggleSidebar()" class="focus:outline-none">
      <i class="fas fa-bars text-2xl"></i>
    </button>
    <h1 class="ml-4 text-xl font-bold">Dashboard</h1>
  </div>

  <div class="flex h-screen pt-14 lg:pt-0">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 bg-gradient-to-b from-purple-600 to-purple-800 text-white h-full shadow-lg fixed lg:relative transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-30">
      <div class="p-6">
        <div class="flex items-center space-x-3">
          <h1 class="text-2xl font-bold mt-4">Admin Project</h1>
        </div>
        <!-- Close button inside sidebar (mobile only) -->
        <div class="flex justify-end lg:hidden mt-4">
          <button onclick="toggleSidebar()" class="text-white text-xl">
            <!-- <i class="fas fa-times"></i> -->
          </button>
        </div>
      </div>
      <nav class="mt-6">
        <ul>
          <!-- Dashboard -->
          <li>
            <a href="{{ route('dashboard') }}" class="flex items-center py-3 px-5 rounded-lg hover:bg-purple-700">
              <i class="fas fa-tachometer-alt text-lg text-yellow-300 mr-4"></i>
              <span class="font-medium">Beranda</span>
            </a>
          </li>

          <!-- Master Data -->
          <li>
            <button onclick="toggleDropdown()" class="w-full text-left flex items-center justify-between py-3 px-5 rounded-lg hover:bg-purple-700">
              <span class="flex items-center">
                <i class="fas fa-folder text-lg text-green-300 mr-4"></i>
                <span class="font-medium">Master Data</span>
              </span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <ul id="master-data-menu" class="hidden bg-purple-700 ml-4 rounded-lg">
              <li>
                <a href="{{ route('produk.index') }}" class="flex items-center py-3 px-5 rounded-lg hover:bg-purple-600">
                  <i class="fas fa-box text-yellow-300 mr-4"></i>
                  Produk
                </a>
              </li>
              <li>
                <a href="{{ route('postingan.index') }}" class="flex items-center py-3 px-5 rounded-lg hover:bg-purple-600">
                  <i class="fas fa-pencil-alt text-orange-300 mr-4"></i>
                  Postingan Produk
                </a>
              </li>
            </ul>
          </li>

          <!-- Pemesanan -->
          <li>
            <a href="{{ route('pemesanan.index') }}" class="flex items-center py-3 px-5 rounded-lg hover:bg-purple-600">
              <i class="fas fa-shopping-cart text-blue-300 mr-4"></i>
              Pemesanan Produk
            </a>
          </li>
        <!-- Pemesanan -->
        <li>
            <a href="{{ route('laporan.produk') }}" class="flex items-center py-3 px-5 rounded-lg hover:bg-purple-600">
              <i class="fas fa-chart-bar text-blue-300 mr-4"></i>
              Laporan Produk
            </a>
          </li>
          <!-- Logout -->
          <li class="absolute bottom-4 w-full">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="flex items-center py-3 px-5 w-full text-left rounded-lg hover:bg-purple-700">
                <i class="fas fa-sign-out-alt text-lg text-red-400 mr-4"></i>
                <span class="font-medium">Logout</span>
              </button>
            </form>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-4 overflow-y-auto z-10">
      @yield('content')  <!-- Konten halaman akan ditampilkan di sini -->
      @yield('scripts')
    </div>
  </div>
</body>
</html>
