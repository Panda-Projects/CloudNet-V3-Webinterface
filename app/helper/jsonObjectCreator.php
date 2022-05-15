<?php

namespace App\Helper;

class jsonObjectCreator
{

    public static function createServiceTaskObject(string $name, int $memory, string $env, array $node, int $defaultPort,
                                                   bool $static, bool $autoDeleteOnStop, bool $maintenance, array $group = array()): string|false
    {
        $task = array(
            "name" => $name,
            "runtime" => "jvm",
            "javaCommand" => null,
            "disableIpRewrite" => false,
            "maintenance" => $maintenance,
            "autoDeleteOnStop" => $autoDeleteOnStop,
            "staticServices" => $static,
            "associatedNodes" => $node,
            "groups" => $group,
            "deletedFilesAfterStop" => [],
            "processConfiguration" => array(
                "environment" => strtoupper($env),
                "maxHeapMemorySize" => $memory,
                "jvmOptions" => [],
                "processParameters" => []
            ),
            "startPort" => $defaultPort,
            "minServiceCount" => 1,
            "includes" => [],
            "templates" => array(array(
                "prefix" => $name,
                "name" => "default",
                "storage" => "local",
                "alwaysCopyToStaticServices" => false
            )),
            "deployments" => [],
            "properties" => array(
                "smartConfig" => array(
                    "enabled" => false,
                    "priority" => 10,
                    "directTemplatesAndInclusionsSetup" => true,
                    "preparedServices" => 0,
                    "dynamicMemoryAllocation" => false,
                    "dynamicMemoryAllocationRange" => 256,
                    "percentOfPlayersToCheckShouldAutoStopTheServiceInFuture" => 0,
                    "autoStopTimeByUnusedServiceInSeconds" => 180,
                    "percentOfPlayersForANewServiceByInstance" => 100,
                    "forAnewInstanceDelayTimeInSeconds" => 300,
                    "minNonFullServices" => 0,
                    "templateInstaller" => "INSTALL_ALL",
                    "maxServiceCount" => -1
                ),
                "requiredPermission" => null
            )
        );
        return json_encode($task);
    }
}