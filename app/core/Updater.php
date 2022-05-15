<?php

class Updater
{
    public function createBackup() {
        $zip = new ZipArchive();
        $filename = "../storage/backup-" . $this->getCurrentVersion() . ".zip";

        $updateFiles = json_decode($this->getUpdateFile(), true);
        $updateFolder = __DIR__ . "../../..";

        if($zip->open($filename, ZipArchive::CREATE) !== true)
            $this->sendResponse(['task' => 'create zip file', 'success' => false]);


        if(array_key_exists('addFiles', $updateFiles)) {
            $addFiles = $updateFiles['addFiles'];
            for($i = 0, $c = count($addFiles); $i < $c; $i++) {
                if(file_exists($updateFolder . $addFiles[$i]['local'])) {
                    if($zip->addFile($updateFolder . $addFiles[$i]['local'], $addFiles[$i]['local']) === false) {
                        $this->sendResponse(['task' => 'add file into zip', 'success' => false]);
                    }
                }
            }
            $deleteFiles = $updateFiles['deleteFiles'];
            for($i = 0, $c = count($deleteFiles); $i < $c; $i++) {
                if(file_exists($updateFolder . $deleteFiles[$i])) {
                    $zip->addFile($updateFolder . $deleteFiles[$i]);
                }
            }
        }

        $zip->close();
    }

    public function installFiles() {
        $this->createBackup();

        $updateFiles = json_decode($this->getUpdateFile(), true);
        $updateFolder = __DIR__ . "../../..";
        $versionUrl = 'https://files.panda-studios.eu/2/';

        if(array_key_exists('addFiles', $updateFiles)) {
            $addFiles = $updateFiles['addFiles'];
            for($i = 0, $c = count($addFiles); $i < $c; $i++) {
                $content = @file_get_contents($versionUrl . $addFiles[$i]['remote']);
                $pathInfo = pathinfo($updateFolder . $addFiles[$i]['local']);

                if(!file_exists($pathInfo['dirname'])) {
                    if (!mkdir($concurrentDirectory = $pathInfo['dirname'], 0775, true) && !is_dir($concurrentDirectory)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
                    }
                }

                file_put_contents($updateFolder . $addFiles[$i]['local'], $content);
                chmod($updateFolder . $addFiles[$i]['local'], 0777);
            }
        }

        if(array_key_exists('deleteFiles', $updateFiles)) {
            for ($i = 0, $c = count($updateFiles['deleteFiles']); $i < $c; $i++) {
                if (file_exists($updateFolder . $updateFiles['deleteFiles'][$i])) {
                    if (is_dir($updateFolder . $updateFiles['deleteFiles'][$i])) {
                        rmdir($updateFolder . $updateFiles['deleteFiles'][$i]);
                    } else {
                        unlink($updateFolder . $updateFiles['deleteFiles'][$i]);
                    }
                }
            }
        }

    }

    public function updateVersion() {
        $updateVersion = json_decode($this->getUpdateFile(), true);
        file_put_contents(__DIR__ . "/version.json", json_encode(array("version" => $updateVersion["latestVersion"])));
    }

    public function versionIsCurrent() {
        $versionChanges = json_decode($this->getRemoteVersion(), true);
        $currentVersion = $this->getCurrentVersion();
        $updateVersion = $versionChanges;
        $current = true;

        if($updateVersion > $currentVersion) {
            $current = false;
        }

        return ['current' => $current, 'currentVersion' => $currentVersion, 'updateVersion' => $updateVersion];
    }

    public function isNewVersionAvailable() {
        return !$this->versionIsCurrent()['current'];
    }

    public function wantsForceUpdate() {
        return true;
    }

    public function checkForScripts() {
        $spyc = Spyc::YAMLLoad($this->getUpdateFile());
        $updateFolder = $_SESSION['root'];
        $exists = true;

        if(!array_key_exists('scripts', $spyc)) {
            $exists = false;
        }


        foreach ($spyc['scripts'] as $script) {
            if(!file_exists($updateFolder . $script)) {
                $exists = false;
                break;
            }
        }

        $this->sendResponse(['task' => 'check if scripts exists', 'exists' => $exists]);
    }

    public function checkRemoteFilesExists() {
        // TODO: Code to check file exists
        $this->sendResponse(['exists' => true]);
    }

    public function checkUpdateFileExists() {
        $versionUrl = 'https://api.panda-studios.eu/updater/1/info.json';
        $file = @file_get_contents($versionUrl);
        $exists = true;

        if($file === false) {
            $exists = false;
        }

        $this->sendResponse(['exists' => $exists, 'url' => $versionUrl]);
    }

    public function executeScripts() {
        $changes = json_decode($this->getUpdateFile());
        $updateFolder = $_SESSION['root'];
        $exists = true;

        if(!array_key_exists('scripts', $changes)) {
            $exists = false;
        } else {
            foreach ($changes['scripts'] as $script) {
                if(file_exists($updateFolder . $script)) {
                    include_once($updateFolder . $script);
                }
            }
        }

        $this->sendResponse([]);
    }

    public function checkFilesAreWriteable() {
        $spyc = $this->getUpdateFile();
        $writeable = $this->checkUpdateFilesWritable($spyc);

        if($writeable) {
            $writeable = $this->checkDeleteFilesWriteable($spyc);
        }

        return $writeable;
    }

    private function checkUpdateFilesWritable($update) {
        $updateFiles = json_decode($update, true)["addFiles"];

        for($i = 0, $c = count($updateFiles); $i < $c; $i++) {
            $file = $updateFiles[$i]['local'];
            return $this->checkFileIsWriteable($file);
        }

        return true;
    }

    private function checkDeleteFilesWriteable($delete) {
        $writeable = true;
        $delete = json_decode($delete, true);
        if(!array_key_exists('deleteFiles', $delete))
            return true;

        $deleteFiles = $delete['deleteFiles'];
        for($i = 0, $c = count($deleteFiles); $i < $c; $i++) {
            $file = $deleteFiles[$i];
            $writeable = $this->checkFileIsWriteable($file);
            if(!$writeable)
                break;
        }

        return $writeable;
    }

    private function checkFileIsWriteable($file) {
        $updateFolder = __DIR__ . "../../";
        $pathInfo = pathinfo($updateFolder . $file);

        if(file_exists($updateFolder . $file) && !is_writable($updateFolder . '/' . $file)) {
            return false;
        }

        if(file_exists($pathInfo['dirname']) && !is_writable($pathInfo['dirname'])) {
            return false;
        }

        $pathParts = explode('/', $pathInfo['dirname']);
        if(count($pathParts) === 1) {
            $pathParts = explode("\\", $pathInfo['dirname']);
        }

        foreach($pathParts as $key=>$pathPart) {
            if($key == 0)
                $pathToCheck = $pathPart;
            else
                $pathToCheck = $updateFolder . $pathPart;

            if(file_exists($pathToCheck)) {
                if(!is_writable($pathToCheck)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * get current version from version.txt
     *
     * @return string
     */
    public function getCurrentVersion() {
        return json_decode(file_get_contents(__DIR__ . "/version.json"), true)["version"];
    }

    public function getRemoteVersion() {
        $content = file_get_contents("https://api.panda-studios.eu/projects/2/version");
        if($content === false) {
            return $this->getCurrentVersion();
        }
        return json_decode($content, true)['version'];
    }

    public function getUpdateFile() {
        return file_get_contents("https://api.panda-studios.eu/projects/2/updater/" . $this->getCurrentVersion() . "/changes");
    }

    /**
     * send a response
     *
     * @param $array
     * @return void
     */
    public function sendResponse($array) {
        header('Content-Type: application/json');
        echo(json_encode($array));
        die();
    }
}