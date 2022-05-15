<?php

use App\Helper\urlHelper;

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <h6 class="mb-4 font-semibold dark:text-white text-gray-900">Edit <?= $task['task']['name']; ?></h6>
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-1">

                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">


                            <form method="post">
                                <input name="action" value="editTask" type="hidden">
                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                                <div class="coding inverse-toggle px-5 pt-4 text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                                    <div class="top mb-2 flex">
                                        <h4 class="mb-2 font-semibold dark:text-white text-gray-900">Edit Task</h4>
                                    </div>
                                    <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                        <div class="w-full flex-1 mx-2">
                                            <label for="name">Name</label>
                                            <input placeholder="Name"
                                                   value="<?= $task['task']['name']; ?>"
                                                   id="name"
                                                   name="name"
                                                   type="text"
                                                   class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                   required
                                            >
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label for="memory">Memory</label>
                                            <input placeholder="Ram"
                                                   name="memory"
                                                   id="memory"
                                                   type="number"
                                                   min="0"
                                                   value="<?= $task['task']['processConfiguration']['maxHeapMemorySize']; ?>"
                                                   class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                   required
                                            >
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label for="environment">environment</label>
                                            <select
                                                name="environment"
                                                id="environment"
                                                class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                required
                                            >
                                                <option disabled class="text-sm font-mono subpixel-antialiased">
                                                    Select Environment
                                                </option>
                                                <option value="minecraft_server" <?php if($task['task']['processConfiguration']['environment'] == "MINECRAFT_SERVER") echo "selected"; ?>
                                                        class="text-sm font-mono subpixel-antialiased">
                                                    Minecraft Server
                                                </option>
                                                <option value="glowstone" <?php if($task['task']['processConfiguration']['environment'] == "GLOWSTONE") echo "selected"; ?>
                                                        class="text-sm font-mono subpixel-antialiased">
                                                    Glowstone
                                                </option>
                                                <option value="nukkit" <?php if($task['task']['processConfiguration']['environment'] == "NUKKIT") echo "selected"; ?>
                                                        class="text-sm font-mono subpixel-antialiased">
                                                    Nukkit
                                                </option>
                                                <option value="go_mint" <?php if($task['task']['processConfiguration']['environment'] == "GO_MINT") echo "selected"; ?>
                                                        class="text-sm font-mono subpixel-antialiased">
                                                    Go Mint
                                                </option>
                                                <option value="bungeecord" <?php if($task['task']['processConfiguration']['environment'] == "BUNGEECORD") echo "selected"; ?>
                                                        class="text-sm font-mono subpixel-antialiased">
                                                    Bungeecord
                                                </option>
                                                <option value="velocity" <?php if($task['task']['processConfiguration']['environment'] == "VELOCITY") echo "selected"; ?>
                                                        class="text-sm font-mono subpixel-antialiased">
                                                    Velocity
                                                </option>
                                                <option value="waterdog_pe" <?php if($task['task']['processConfiguration']['environment'] == "WATERDOG_PE") echo "selected"; ?>
                                                        class="text-sm font-mono subpixel-antialiased">
                                                    Waterdog PE
                                                </option>
                                            </select>
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label for="nodes">Nodes</label>
                                            <select
                                                multiple
                                                name="node[]"
                                                id="nodes"
                                                class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                required
                                            >
                                                <option disabled class="text-sm font-mono subpixel-antialiased">
                                                    Select Node
                                                </option>
                                                <?php
                                                $nodes = urlHelper::buildDefaultRequest("cluster", "GET");
                                                foreach ($nodes as $node) { ?>
                                                    <option class="text-sm font-mono subpixel-antialiased" <?php if(in_array($node['node']['uniqueId'], $task['task']['associatedNodes'])) echo "selected"; ?>
                                                    ><?= $node['node']['uniqueId']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label for="groups">Groups</label>
                                            <select
                                                multiple
                                                name="group[]"
                                                id="groups"
                                                class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                required
                                            >
                                                <option disabled class="text-sm font-mono subpixel-antialiased">
                                                    Select Group
                                                </option>
                                                <?php
                                                $groups = urlHelper::buildDefaultRequest("groups", "GET");
                                                foreach ($groups as $group) { ?>
                                                    <option class="text-sm font-mono subpixel-antialiased" <?php if(in_array($group['name'], $task['task']['groups'])) echo "selected"; ?>
                                                    ><?= $group['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label for="port">Port</label>
                                            <input placeholder="Port"
                                                   id="port"
                                                   name="port"
                                                   type="number"
                                                   min="0"
                                                   max="65535"
                                                   value="<?= $task['task']['startPort']; ?>"
                                                   class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600"
                                                   required
                                            >
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label class="inline-flex items-center mt-3">
                                                <input type="checkbox" name="static" class="form-checkbox h-5 w-5" <?php if($task['task']['staticServices']) echo "checked"; ?>>
                                                <span class="ml-2 dark:text-white text-gray-900">Static</span>
                                            </label>
                                            <label class="inline-flex items-center mt-3">
                                                <input type="checkbox" name="auto_delete_on_stop" <?php if($task['task']['autoDeleteOnStop']) echo "checked"; ?>
                                                       class="form-checkbox h-5 w-5">
                                                <span class="ml-2 dark:text-white text-gray-900">AutoDeleteOnStop</span>
                                            </label>
                                            <label class="inline-flex items-center mt-3">
                                                <input type="checkbox" name="maintenance" class="form-checkbox h-5 w-5" <?php if($task['task']['maintenance']) echo "checked"; ?>>
                                                <span class="ml-2 dark:text-white text-gray-900">Maintenance</span>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>