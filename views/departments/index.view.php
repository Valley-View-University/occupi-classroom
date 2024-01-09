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
                        <?php foreach ($departments as $department): ?>
                            <a class="group" href="/departments/<?= $department['short_hand'] ?>/classrooms">
                                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                    <img alt=""
                                         class="h-full w-full object-cover object-center group-hover:opacity-75"
                                         src="<?= assets("images/${department['image']}") ?>">
                                </div>
                                <div class="mt-4 flex flex-row items-center gap-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                         stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>


                                    <h3 class="text-sm text-gray-700">
                                        <?= $department['name'] ?>
                                    </h3>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </main>
    </div>

<?php require base_path('views/partials/footer.php') ?>