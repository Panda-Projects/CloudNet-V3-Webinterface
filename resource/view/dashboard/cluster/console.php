<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(() => {
        let socketUrl = "<?= webinterface\main::provideSocketUrl() . "/node/" . $node_id . "/liveConsole?ticket=" . $ticket; ?>";
        let websocket = new WebSocket(socketUrl);

        websocket.onerror = () => websocket.close()

        websocket.onmessage = (event) => showMessage('<div class="dark:text-gray-200 text-gray-800 text-sm">' + event.data + '</div>')
        websocket.onclose = () => showMessage('<div class="dark:text-gray-200 text-gray-800 text-sm">Connection closed by server</div>')

        setInterval(() => websocket.send(''), 15_000)

        // command sending

        $('#execute-command').bind("click", () => pushCommandExecute(websocket))
        $(document).on("keypress", (event) => {
            if (event.which === 13) {
                pushCommandExecute(websocket)
            }
        })
    });

    function showMessage(messageHTML) {
        $('#socket_event')?.prepend(messageHTML);
    }

    function pushCommandExecute(websocket) {
        let commandInput = $('#command-input')
        let command = commandInput.val()

        if (command) { // check if there is an input
            websocket.send(command)
            commandInput.val('') // reset input field
        }
    }
</script>

<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-1">
                    <!-- Command input -->
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <h4 class="mb-2 font-semibold dark:text-white text-gray-900">Send command</h4>
                            </div>
                            <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                <div class="w-full flex-1 mx-2">
                                    <input placeholder="Command"
                                           id="command-input"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                </div>
                            </div>
                            <button type="button"
                                    id="execute-command"
                                    class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                Execute
                            </button>
                        </div>
                    </div>
                    <!-- Create text output node -->
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div id="socket_event"></div>

                            <?php
                            #$console = \webinterface\main::buildDefaultRequest("node/" . $node_id."/logLines", "GET");
                            #print_r($console);
                            #foreach(array_reverse($console['lines']) as $log){
                            #    echo '<div class="dark:text-gray-200 text-gray-800 text-sm">'.$log.'</div>';
                            #}
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>