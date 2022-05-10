<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <!-- Nodes start -->
                    <?php

                    use App\Helper\urlHelper;

                    $nodes = urlHelper::buildDefaultRequest("cluster", "GET");


                    foreach ($nodes as $node) { ?>

                        <div class="min-w-0 p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg border-t-4 border-green-600">
                            <div class="flex items-center justify-between">
                                <h4 class="mb-4 font-semibold text-blue-500"><?= $node['node']['uniqueId']; ?></h4>
                                <!-- State Starting: bg-yellow-600 // State Stop: bg-red-600 -->
                                <?php if (count($node['node']["listeners"]) != 0) { ?>
                                    <span class="text-sm text-center text-white h-6 w-16 bg-green-600 rounded-full">Online</span>
                                <?php } else { ?>
                                    <span class="text-sm text-center text-white h-6 w-16 bg-red-600 rounded-full">Offline</span>
                                <?php } ?>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">Memory
                                    Usage: <?= $node['nodeInfoSnapshot']['usedMemory']; ?>
                                    MB/<?= $node['nodeInfoSnapshot']['maxMemory']; ?>MB<br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">CPU
                                    Usage: <?= min(round($node['nodeInfoSnapshot']['processSnapshot']['cpuUsage'] * 100), 100); ?>
                                    %<br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    Version: <?= $node['nodeInfoSnapshot']['version'] ?><br></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    Host: <?= $node['node']['listeners'][0]['host'] . ":" . $node['node']['listeners'][0]['port']; ?>
                                    <br></p>
                            </div>
                            <div class="flex justify-center mt-4 space-x-3 text-sm text-white">
                                <div class="flex items-center">
                                    <form method="post">
                                        <input name="action" value="stopNode" type="hidden">
                                        <input name="node_id" value="<?= $node['node']['uniqueId']; ?>" type="hidden">
                                        <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">

                                        <button type="submit"
                                                class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                            Shutdown
                                        </button>
                                    </form>
                                    <?php if (count($nodes) > 1) { ?>
                                        <form method="post">
                                            <input name="action" value="deleteNode" type="hidden">
                                            <input name="node_id" value="<?= $node['node']['uniqueId']; ?>"
                                                   type="hidden">
                                            <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">

                                            <button type="submit"
                                                    class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                                Delete
                                            </button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Nodes end-->
                </div>
            </div>
        </main>
    </div>

    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-1">
                    <!-- Create Node -->
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <h4 class="mb-2 font-semibold dark:text-white text-gray-900">Create Node</h4>
                            </div>
                            <form method="post">
                                <input name="action" value="createNode" type="hidden">
                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">

                                <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Name" name="name" required
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Host" name="host" required
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Port" name="port" required
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                                <button type="submit"
                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Create
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>