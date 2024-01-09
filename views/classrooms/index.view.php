<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="bg-white px-6 py-10">
            <ul role="list" class="divide-y divide-gray-100">
                <?php if (count($available_classrooms) === 0): ?>
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">No classrooms available</p>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <?php foreach ($available_classrooms as $classroom): ?>
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                 src="https://avatars.githubusercontent.com/u/61436567?v=4"
                                 alt="">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900"><?= ucfirst($classroom['lecturer_name']) ?></p>
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500"><?= $classroom['course_code'] . ' - ' . $classroom['course_name'] ?></p>
                            </div>
                        </div>
                        <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900"><?= $classroom['classroom'] . ' - ' . $classroom['time_start'] . ' - ' . $classroom['time_end'] . ' - ' . getDay($classroom['day']) ?></p>
                            <div class="mt-1 flex items-center gap-x-1.5">
                                <?php if (isTimeInRange($classroom)): ?>
                                    <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                        <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                                    </div>

                                    <p class="text-xs leading-5 text-gray-500">Class live</p>
                                <?php else: ?>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        <?= ucfirst(calculate_last_seen($classroom)); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
