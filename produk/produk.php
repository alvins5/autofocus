<?php
include '../header/header-fixed.php';
include '../header/header-floating.php';
?>
   <!-- Search Bar -->
<div class="main-content">
   <div class="container mx-auto mt-4 px-4 flex justify-center">
       <div class="relative">
           <input placeholder="Search..." class="input shadow-lg bg-stone-900 focus:border-2 border-gray-300 px-5 py-3 rounded-xl w-56 transition-all focus:w-64 outline-none" name="search" type="search" />
       </div>
   </div>
  <div class="container mx-auto p-4">
    <div class="flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <div class="w-full lg:w-1/4 p-4 bg-gray-800 text-white rounded-lg">
     <h2 class="text-lg font-semibold mb-4">
      Result For ***
     </h2>
     <p class="text-sm mb-4">
      *** results found
     </p>
     <div class="mb-4">
      <label class="block text-sm font-medium mb-2" for="keyword">
       Keyword
      </label>
      <input class="w-full p-2 rounded bg-gray-700 text-white mb-2" id="keyword" placeholder="Search keyword..." type="text"/>
     </div>
     <div class="mb-4">
      <label class="block text-sm font-medium mb-2" for="brand">
       Brand
      </label>
      <input class="w-full p-2 rounded bg-gray-700 text-white mb-2" id="brand" placeholder="Search brand..." type="text"/>
      <div class="flex flex-col">
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Canon
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Nikon
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Sony
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Fujifilm
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Lomography
        </span>
       </label>
      </div>
     </div>
     <div class="mb-4">
      <label class="block text-sm font-medium mb-2" for="category">
       Category
      </label>
      <input class="w-full p-2 rounded bg-gray-700 text-white mb-2" id="category" placeholder="Search category..." type="text"/>
      <div class="flex flex-col">
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Digital Camera
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Lens
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Accessories
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Video Camera
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Tripod
        </span>
       </label>
      </div>
     </div>
     <div class="mb-4">
      <label class="block text-sm font-medium mb-2" for="condition">
       Condition
      </label>
      <div class="flex flex-col">
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         New
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         Used
        </span>
       </label>
      </div>
     </div>
     <div class="mb-4">
      <label class="block text-sm font-medium mb-2" for="price">
       Price
      </label>
      <div class="flex flex-col">
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         IDR 0 - 1.000.000
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         IDR 1.000.000 - 5.000.000
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         IDR 5.000.000 - 10.000.000
        </span>
       </label>
       <label class="inline-flex items-center">
        <input class="form-checkbox" type="checkbox"/>
        <span class="ml-2">
         IDR 10.000.000 - 20.000.000
        </span>
       </label>
      </div>
     </div>
    </div>
    <!-- Main Content -->
    <div class="w-full lg:w-3/4 p-4">
     <div class="flex justify-between items-center mb-4">
      <div class="text-sm">
       <span>
        Sort by:
       </span>
       <select class="p-2 rounded bg-gray-700 text-white">
        <option>
         Relevance
        </option>
        <option>
         Price: Low to High
        </option>
        <option>
         Price: High to Low
        </option>
       </select>
      </div>
      <div class="text-sm"> 
       <a href="produk-grid.html" class="fas fa-th-large">
       </a>
      </div>
     </div>
     <div class="space-y-4">
      <!-- Product Item -->
      <div class="flex flex-col md:flex-row items-center p-4 bg-gray-800 text-white rounded-lg">
       <img alt="Product image" class="w-24 h-24 object-cover rounded-lg" height="100" src="img/kamera.jpg" width="100"/>
       <div class="ml-4 flex-1 text-center md:text-left mt-2 md:mt-0">
        <h3 class="text-lg font-semibold">
         Nama Product
        </h3>
        <p class="text-sm text-white">
         Deskripsi
        </p>
       </div>
       <div class="text-center md:text-right mt-2 md:mt-0">
        <p class="text-lg font-semibold">
         IDR XXX.XXX/day
        </p>
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
         + Cart
        </button>
       </div>
      </div>
      <!-- Repeat Product Item -->
      <div class="flex flex-col md:flex-row items-center p-4 bg-gray-800 text-white rounded-lg">
       <img alt="Product image" class="w-24 h-24 object-cover rounded-lg" height="100" src="img/kamera.jpg" width="100"/>
       <div class="ml-4 flex-1 text-center md:text-left mt-2 md:mt-0">
        <h3 class="text-lg font-semibold">
         Nama Product
        </h3>
        <p class="text-sm text-white">
         Deskripsi
        </p>
       </div>
       <div class="text-center md:text-right mt-2 md:mt-0">
        <p class="text-lg font-semibold">
         IDR XXX.XXX/day
        </p>
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
         + Cart
        </button>
       </div>
      </div>
      <div class="flex flex-col md:flex-row items-center p-4 bg-gray-800 text-white rounded-lg">
       <img alt="Product image" class="w-24 h-24 object-cover rounded-lg" height="100" src="img/kamera.jpg" width="100"/>
       <div class="ml-4 flex-1 text-center md:text-left mt-2 md:mt-0">
        <h3 class="text-lg font-semibold">
         Nama Product
        </h3>
        <p class="text-sm text-white">
         Deskripsi
        </p>
       </div>
       <div class="text-center md:text-right mt-2 md:mt-0">
        <p class="text-lg font-semibold">
         IDR XXX.XXX/day
        </p>
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
         + Cart
        </button>
       </div>
      </div>
      <div class="flex flex-col md:flex-row items-center p-4 bg-gray-800 text-white rounded-lg">
       <img alt="Product image" class="w-24 h-24 object-cover rounded-lg" height="100" src="img/kamera.jpg" width="100"/>
       <div class="ml-4 flex-1 text-center md:text-left mt-2 md:mt-0">
        <h3 class="text-lg font-semibold">
         Nama Product
        </h3>
        <p class="text-sm text-white">
         Deskripsi
        </p>
       </div>
       <div class="text-center md:text-right mt-2 md:mt-0">
        <p class="text-lg font-semibold">
         IDR XXX.XXX/day
        </p>
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
         + Cart
        </button>
       </div>
      </div>
      <div class="flex flex-col md:flex-row items-center p-4 bg-gray-800 text-white rounded-lg">
       <img alt="Product image" class="w-24 h-24 object-cover rounded-lg" height="100" src="img/kamera.jpg" width="100"/>
       <div class="ml-4 flex-1 text-center md:text-left mt-2 md:mt-0">
        <h3 class="text-lg font-semibold">
         Nama Product
        </h3>
        <p class="text-sm text-white">
         Deskripsi
        </p>
       </div>
       <div class="text-center md:text-right mt-2 md:mt-0">
        <p class="text-lg font-semibold">
         IDR XXX.XXX/day
        </p>
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
         + Cart
        </button>
       </div>
      </div>
      <div class="flex flex-col md:flex-row items-center p-4 bg-gray-800 text-white rounded-lg">
       <img alt="Product image" class="w-24 h-24 object-cover rounded-lg" height="100" src="img/kamera.jpg" width="100"/>
       <div class="ml-4 flex-1 text-center md:text-left mt-2 md:mt-0">
        <h3 class="text-lg font-semibold">
         Nama Product
        </h3>
        <p class="text-sm text-white">
         Deskripsi
        </p>
       </div>
       <div class="text-center md:text-right mt-2 md:mt-0">
        <p class="text-lg font-semibold">
         IDR XXX.XXX/day
        </p>
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
         + Cart
        </button>
       </div>
      </div>
      <div class="flex flex-col md:flex-row items-center p-4 bg-gray-800 text-white rounded-lg">
       <img alt="Product image" class="w-24 h-24 object-cover rounded-lg" height="100" src="img/kamera.jpg" width="100"/>
       <div class="ml-4 flex-1 text-center md:text-left mt-2 md:mt-0">
        <h3 class="text-lg font-semibold">
         Nama Product
        </h3>
        <p class="text-sm text-white">
         Deskripsi
        </p>
       </div>
       <div class="text-center md:text-right mt-2 md:mt-0">
        <p class="text-lg font-semibold">
         IDR XXX.XXX/day
        </p>
        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
         + Cart
        </button>
       </div>
      </div>
     </div>
     <!-- Pagination -->
     <div class="flex justify-center mt-4">
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         1
        </button>
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         2
        </button>
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         3
        </button>
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         4
        </button>
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         5
        </button>
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         6
        </button>
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         7
        </button>
        <button class="p-2 rounded bg-gray-700 text-white mx-1">
         ...
        </button>
     </div>
    </div>
   </div>
  </div>
<?php
include 'footer.php';
