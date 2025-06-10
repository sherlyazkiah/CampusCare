<aside id="logo-sidebar"
   class="fixed top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
   aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <!-- Dashboard -->
         <li>
            <a href="{{ route('technician.dashboard') }}"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <!-- Home Icon -->
               <svg
                  class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                     d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-4 0h4" />
               </svg>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>

         <!-- Tasks -->
         <li>
            <a href="{{ route('technician.task') }}"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <!-- Clipboard List Icon -->
               <svg
                  class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                     d="M9 5h6M9 3h6m-6 4h6m-2 4h4m-4 4h4M4 6h16v14H4z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Tasks</span>
            </a>
         </li>

         <!-- History -->
         <li>
            <a href="{{ route('technician.history') }}"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <!-- Clock Icon -->
               <svg
                  class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                     d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">History</span>
            </a>
         </li>

         <!-- Logout -->
         <li>
            <form method="POST" action="{{ route('logout') }}">
               @csrf
               <button type="submit"
                  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg
                     class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                  </svg>
                  <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
               </button>
            </form>
         </li>
      </ul>
   </div>
</aside>