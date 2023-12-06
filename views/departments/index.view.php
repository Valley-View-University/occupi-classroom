<?php require base_path('views/partials/head.php') ?>
    <div class="min-h-full">
    <div class="sticky top-0 z-10">
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
    </div>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <h2 class="sr-only">Departments</h2>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                        <a class="group" href="#">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img alt=""
                                     class="h-full w-full object-cover object-center group-hover:opacity-75"
                                     src="<?= assets('images/example_department.jpg') ?>">
                            </div>
                            <div class="mt-4 flex flex-row items-center gap-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>


                                <h3 class="text-sm text-gray-700">
                                    CS/IT
                                </h3>
                            </div>
                        </a>
                        <a class="group" href="#">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img alt="Olive drab green insulated bottle with flared screw lid and flat top."
                                     class="h-full w-full object-cover object-center group-hover:opacity-75"
                                     src="<?= assets('images/example_department.jpg') ?>">
                            </div>
                            <div class="mt-4 flex flex-row items-center gap-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                     stroke-width="1.5"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                <h3 class="text-sm text-gray-700">
                                    Columbia
                                </h3>
                            </div>
                        </a>
                        <a class="group" href="#">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img alt="Person using a pen to cross a task off a productivity paper card."
                                     class="h-full w-full object-cover object-center group-hover:opacity-75"
                                     src="<?= assets('images/example_department.jpg') ?>">
                            </div>
                            <!--                            <h3 class="mt-4 text-sm text-gray-700">Baobab</h3>-->
                            <div class="mt-4 flex flex-row items-center gap-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                     stroke-width="1.5"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                <h3 class="text-sm text-gray-700">
                                    Baobab
                                </h3>
                            </div>
                        </a>
                        <a class="group" href="#">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img alt="Hand holding black machined steel mechanical pencil with brass tip and top."
                                     class="h-full w-full object-cover object-center group-hover:opacity-75"
                                     src="<?= assets('images/example_department.jpg') ?>">
                            </div>
                            <div class="mt-4 flex flex-row items-center gap-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>

                                <h3 class="text-sm text-gray-700">
                                    Graduate School
                                </h3>
                            </div>
                            <!--                            <p class="mt-1 text-lg font-medium text-gray-900">Graduate School</p>-->
                        </a>
                        <a class="group" href="#">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img alt="Hand holding black machined steel mechanical pencil with brass tip and top."
                                     class="h-full w-full object-cover object-center group-hover:opacity-75"
                                     src="<?= assets('images/example_department.jpg') ?>">
                            </div>
                            <div class="mt-4 flex flex-row items-center gap-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>


                                <h3 class="text-sm text-gray-700">
                                    Other
                                </h3>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </main>
    </div>

<?php require base_path('views/partials/footer.php') ?>