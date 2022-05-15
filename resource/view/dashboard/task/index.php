<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">

                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <!-- Tasks start -->
                    <?php

                    use App\Helper\urlHelper;

                    $tasks = urlHelper::buildDefaultRequest("tasks", "GET");


                    foreach ($tasks as $task) { ?>
                        <div class="min-w-0 p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                            <h4 class="mb-4 font-semibold text-blue-500"><?= $task['name'] ?></h4>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    Memory: <?= $task['processConfiguration']['maxHeapMemorySize'] ?>MB<br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">Nodes:
                                    <?php
                                    if (count($task['associatedNodes']) == 0) {
                                        echo "all";
                                    } else {
                                        $nodes = "";
                                        foreach ($task['associatedNodes'] as $node) {
                                            $nodes .= $node . ", ";
                                        }
                                        echo substr($nodes, 0, -2);
                                    }
                                    ?>
                                    <br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    AutoDeleteOnStop: <?= $task['autoDeleteOnStop'] ? "true" : "false"; ?><br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    Static: <?= $task['staticServices'] ? "true" : "false"; ?><br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    StartPort: <?= $task['startPort']; ?><br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">Groups:
                                    <?php
                                    if (count($task['groups']) == 0) {
                                        echo "-";
                                    } else {
                                        $groups = "";
                                        foreach ($task['groups'] as $group) {
                                            $groups .= $group . ", ";
                                        }
                                        echo substr($groups, 0, -2);
                                    }
                                    ?>
                                    <br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    Environment: <?= $task['processConfiguration']['environment'] ?><br></p>
                            </div>
                            <div class="flex justify-center mt-4 space-x-3 text-sm text-white">
                                <div class="flex items-center">
                                    <a href="/tasks/<?= $task['name']; ?>"
                                       class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">Show</a>
                                    <a href="/tasks/<?= $task['name']; ?>/edit"
                                       class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">Edit</a>
                                    <a href="/tasks/<?= $task['name']; ?>/delete"
                                       class="h-10 bg-red-500 text-white rounded-md px-4 py-2 m-2 hover:bg-red-700 focus:outline-none focus:shadow-outline">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Tasks end -->
                </div>
            </div>
        </main>
    </div>
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-1">
                    <!-- Create Task -->
                    <div class="w-full">
                        <form method="post">
                            <input name="action" value="createTask" type="hidden">
                            <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                            <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                                <div class="top mb-2 flex">
                                    <h4 class="mb-2 font-semibold dark:text-white text-gray-900">Create Task</h4>
                                </div>
                                <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Name"
                                               name="name"
                                               type="text"
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                               required
                                        >
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Ram"
                                               name="ram"
                                               type="number"
                                               min="0"
                                               value="512"
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                               required
                                        >
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <select
                                                name="environment"
                                                id="environment-state"
                                                class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                required
                                        >
                                            <option value="" class="text-sm font-mono subpixel-antialiased">
                                                Select Environment
                                            </option>
                                            <option value="minecraft_server"
                                                    class="text-sm font-mono subpixel-antialiased">
                                                Minecraft Server
                                            </option>
                                            <option value="glowstone" class="text-sm font-mono subpixel-antialiased">
                                                Glowstone
                                            </option>
                                            <option value="nukkit" class="text-sm font-mono subpixel-antialiased">
                                                Nukkit
                                            </option>
                                            <option value="go_mint" class="text-sm font-mono subpixel-antialiased">
                                                Go Mint
                                            </option>
                                            <option value="bungeecord" class="text-sm font-mono subpixel-antialiased">
                                                Bungeecord
                                            </option>
                                            <option value="velocity" class="text-sm font-mono subpixel-antialiased">
                                                Velocity
                                            </option>
                                            <option value="waterdog_pe" class="text-sm font-mono subpixel-antialiased">
                                                Waterdog PE
                                            </option>
                                        </select>
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <select
                                                name="node"
                                                id="node-state"
                                                class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                required
                                        >
                                            <option value="" class="text-sm font-mono subpixel-antialiased">
                                                Select Node
                                            </option>
                                            <option value="all" class="text-sm font-mono subpixel-antialiased">
                                                All Nodes
                                            </option>
                                            <?php
                                            $nodes = urlHelper::buildDefaultRequest("cluster", "GET");
                                            foreach ($nodes as $node) { ?>
                                                <option class="text-sm font-mono subpixel-antialiased"><?= $node['node']['uniqueId']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Port"
                                               name="port"
                                               type="number"
                                               min="0"
                                               max="65535"
                                               value="25565"
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                               required
                                        >
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <label class="inline-flex items-center mt-3">
                                            <input type="checkbox" name="static" class="form-checkbox h-5 w-5"><span
                                                    class="ml-2 dark:text-white text-gray-900">Static</span>
                                        </label>
                                        <label class="inline-flex items-center mt-3">
                                            <input type="checkbox" name="auto_delete_on_stop"
                                                   class="form-checkbox h-5 w-5" checked><span
                                                    class="ml-2 dark:text-white text-gray-900">AutoDeleteOnStop</span>
                                        </label>
                                        <label class="inline-flex items-center mt-3">
                                            <input type="checkbox" name="maintenance" class="form-checkbox h-5 w-5"
                                                   checked><span
                                                    class="ml-2 dark:text-white text-gray-900">Maintenance</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>