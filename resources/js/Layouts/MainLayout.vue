<template>
    <div class="dark:bg-zinc-800">
  <!--Main Navigation-->
  <header>
    <!-- Sidenav -->
    <nav
      id="sidenav-1"
      class="fixed left-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] dark:bg-zinc-800 xl:data-[te-sidenav-hidden='false']:translate-x-0"
      data-te-sidenav-init
      data-te-sidenav-hidden="false"
      data-te-sidenav-mode-breakpoint-over="0"
      data-te-sidenav-mode-breakpoint-side="xl"
      data-te-sidenav-content="#content"
      data-te-sidenav-accordion="true">
      <a
        class="mb-3 flex items-center justify-center py-6 outline-none bg-black"
        href="http://tawasolmap.com/en/home/"
        data-te-ripple-init
        data-te-ripple-color="primary">
        <img
          id="te-logo"
          class="mr-2 w-48"
          src= "http://tawasolmap.com/wp-content/uploads/2019/01/logo-tawasolmap-1.png"
          alt="TE Logo"
          draggable="false" />
      </a>

      <ul
        class="relative m-0 list-none px-[0.2rem]"
        data-te-sidenav-menu-ref>
        <li class="relative">
          <a
            class="group flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-primary-400/10 hover:text-primary-600 hover:outline-none focus:bg-primary-400/10 focus:text-primary-600 focus:outline-none active:bg-primary-400/10 active:text-primary-600 active:outline-none data-[te-sidenav-state-active]:text-primary-600 data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            href="/tracking"
            data-te-sidenav-link-ref>
            <span
              class="mr-4 [&>svg]:h-3.5 [&>svg]:w-3.5 [&>svg]:fill-gray-700 [&>svg]:transition [&>svg]:duration-300 [&>svg]:ease-linear group-hover:[&>svg]:fill-primary-600 group-focus:[&>svg]:fill-primary-600 group-active:[&>svg]:fill-primary-600 group-[te-sidenav-state-active]:[&>svg]:fill-primary-600 motion-reduce:[&>svg]:transition-none dark:[&>svg]:fill-gray-300 dark:group-hover:[&>svg]:fill-gray-300 ">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                  d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm96 288H448c17.7 0 32-14.3 32-32V251.8c0-7.6-2.7-15-7.7-20.8l-65.8-76.8c-12.1-14.2-33.7-15-46.9-1.8l-21 21c-10 10-26.4 9.2-35.4-1.6l-39.2-47c-12.6-15.1-35.7-15.4-48.7-.6L135.9 215c-5.1 5.8-7.9 13.3-7.9 21.1v84c0 17.7 14.3 32 32 32z" />
              </svg>
            </span>
            <span>Tracking</span></a
          >
        </li>
      </ul>
    </nav>
    <!-- Sidenav -->
    <!-- Navbar -->
    <nav
      id="main-navbar"
      class="fixed left-0 right-0 top-0 flex w-full flex-nowrap items-center justify-between bg-white py-[0.6rem] text-gray-500 shadow-lg hover:text-gray-700 focus:text-gray-700 dark:bg-zinc-700 lg:flex-wrap lg:justify-start xl:pl-60"
      data-te-navbar-ref>
      <!-- Container wrapper -->
      <div
        class="basis-3/4 justify-between px-4">
        <h3>tawasolmap</h3>
      </div>

      <div
        class="basis-1/4 justify-between px-4">
        <a class="float-right" href="/logout">Logout</a>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main style="margin-top: 58px" class="ms-64 me-8">
    <div class="container">
        <slot/>
    </div>
  </main>

</div>
</template>
<script setup>
import {
  Sidenav,
  Dropdown,
  Ripple,
  initTE,
} from "tw-elements";

initTE({ Sidenav, Dropdown, Ripple });

</script>