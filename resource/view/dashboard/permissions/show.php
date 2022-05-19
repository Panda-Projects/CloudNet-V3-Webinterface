<?php

use App\Helper\urlHelper;

$group = urlHelper::buildDefaultRequest("permissions/" . $group_name);

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-1 xl:grid-cols-2">
                    <div class="min-w-0 p-5 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <h4 class="mb-4 text-2xl font-semibold text-blue-500 text-center"><?= $group["name"] ?></h4>
                        <div class="flex">
                            <p class="flex-1 dark:text-white text-gray-900 text-center p-2"></p>
                        </div>
                        <div class="flex">
                            <span class="text-gray-400">•</span>
                            <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                <?= _CREATED ?>: <?= date("H:i:s d.m.y", intval($group["createdTime"]) / 1000) ?></p>
                        </div>
                        <div class="flex">
                            <span class="text-gray-400">•</span>
                            <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                Permissions: <?= count($group["permissions"]) ?></p>
                        </div>
                        <div class="flex">
                            <span class="text-gray-400">•</span>
                            <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                <?= _GROUPS ?>: <?= count($group["groups"]) ?></p>
                        </div>
                    </div>
                    <div class="min-w-0 p-5 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <form method="post">
                            <input name="action" value="groupSettings" type="hidden">
                            <input name="groupName" value="<?= $group_name ?>" type="hidden">
                            <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                            <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                <div class="w-full flex-1 mx-2">
                                    <label class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2"
                                           for="name">
                                        Name
                                    </label>
                                    <input placeholder="Name"
                                           name="name"
                                           id="name"
                                           type="text"
                                           value="<?= $group["name"] ?>"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                           required
                                    >
                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <label class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2"
                                           for="prefix">
                                        Prefix
                                    </label>
                                    <input placeholder="Prefix"
                                           name="prefix"
                                           id="prefix"
                                           type="text"
                                           value="<?= $group["prefix"] ?>"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                           required
                                    >
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                <div class="w-full flex-1 mx-2">
                                    <label class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2"
                                           for="display">
                                        Display
                                    </label>
                                    <input placeholder="Display"
                                           name="display"
                                           id="display"
                                           type="text"
                                           value="<?= $group["display"] ?>"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                           required
                                    >
                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <label class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2"
                                           for="color">
                                        Color
                                    </label>
                                    <input placeholder="Color"
                                           name="color"
                                           id="color"
                                           type="text"
                                           value="<?= $group["color"] ?>"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                           required
                                    >
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                <div class="w-full flex-1 mx-2">
                                    <label class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2"
                                           for="suffix">
                                        Suffix
                                    </label>
                                    <input placeholder="Suffix"
                                           name="suffix"
                                           id="suffix"
                                           type="text"
                                           value="<?= $group["suffix"] ?>"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                           required
                                    >
                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <label class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2"
                                           for="sortId">
                                        Sort Id
                                    </label>
                                    <input placeholder="Sort Id"
                                           name="sortId"
                                           id="sortId"
                                           type="number"
                                           min="-1"
                                           value="<?= $group["sortId"] ?>"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                           required
                                    >
                                </div>
                            </div>
                            <div class="w-full flex-1 mx-2 items-center">
                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" name="defaultGroup"
                                           class="form-checkbox h-5 w-5" <?php if ($group["defaultGroup"]) echo "checked"; ?>><span
                                            class="ml-2 dark:text-white text-gray-900"><?= _DEFAULT_GROUP ?></span>
                                </label>
                                <button type="submit"
                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="grid gap-6 mb-8 md:grid-cols-1 xl:grid-cols-2">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Permission Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Delete</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($group["permissions"] as $permission) { ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <?= $permission["name"] ?>
                                    </th>
                                    <td class="px-6 py-4 text-right">
                                        <form method="post">
                                            <input name="action" value="deletePermission" type="hidden">
                                            <input name="permissionName" value="<?= $permission["name"] ?>"
                                                   type="hidden">
                                            <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                                            <button type="submit"
                                                    class="font-medium right-0 text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                                     class="text-red-500 h-6"
                                                     fill="currentColor">
                                                    <path d="M21,4H17.9A5.009,5.009,0,0,0,13,0H11A5.009,5.009,0,0,0,6.1,4H3A1,1,0,0,0,3,6H4V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5V6h1a1,1,0,0,0,0-2ZM11,2h2a3.006,3.006,0,0,1,2.829,2H8.171A3.006,3.006,0,0,1,11,2Zm7,17a3,3,0,0,1-3,3H9a3,3,0,0,1-3-3V6H18Z"/>
                                                    <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18Z"/>
                                                    <path d="M14,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Group
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Delete</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($group["groups"] as $groups) { ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <?= $groups ?>
                                    </th>
                                    <td class="px-6 py-4 text-right">
                                        <form method="post">
                                            <input name="action" value="deleteGroup" type="hidden">
                                            <input name="groupName" value="<?= $groups ?>" type="hidden">
                                            <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                                            <button type="submit"
                                                    class="font-medium right-0 text-blue-600 dark:text-blue-$groups hover:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                                     class="text-red-500 h-6"
                                                     fill="currentColor">
                                                    <path d="M21,4H17.9A5.009,5.009,0,0,0,13,0H11A5.009,5.009,0,0,0,6.1,4H3A1,1,0,0,0,3,6H4V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5V6h1a1,1,0,0,0,0-2ZM11,2h2a3.006,3.006,0,0,1,2.829,2H8.171A3.006,3.006,0,0,1,11,2Zm7,17a3,3,0,0,1-3,3H9a3,3,0,0,1-3-3V6H18Z"/>
                                                    <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18Z"/>
                                                    <path d="M14,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <h4 class="mb-2 font-semibold dark:text-white text-gray-900"><?= _ADD_PERMISSION ?></h4>
                            </div>
                            <form method="post">
                                <input name="action" value="addPermission" type="hidden">
                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">

                                <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Permission Name" name="name" required
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                                <button type="submit"
                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    <?= _CREATE ?>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <h4 class="mb-2 font-semibold dark:text-white text-gray-900"><?= _ADD_GROUP ?></h4>
                            </div>
                            <form method="post">
                                <input name="action" value="addPermission" type="hidden">
                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">

                                <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Group Name" name="name" required
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                                <button type="submit"
                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    <?= _CREATE ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>