<?php
require_once __DIR__ . '/vendor/autoload.php';

class Test
{
    public static function run(int $alg = \App\NodesManager::SEARCH_ALGORITHM__BINARY)
    {
        $preparationsStartTime = microtime(true);
// main init
        $slotsCount = 10000;
        $nodesCount = 2000;
        $hashObjectPrefix = 'prefix_';
        $emulateObjects = 1000000;

        $nodeManager = new \App\NodesManager();

        // node name -> hit count
        $nodesStats = [];
        // fill nodes and manager
        for ($i = 1; $i <= $nodesCount; $i++) {
            $nodeName = 'node_' . sprintf('%04d', $i);
            self::writeLn("$nodeName");
            $node = new \App\Node($nodeName, $slotsCount);
            $nodeManager->addNode($node);
            $nodesStats[$node->getName()] = 0;
        }
        self::writeLn("Sorting: started");
        $nodeManager->sortHashesNodes();
        self::writeLn("Sorting: finished");

        $preparationsFinishTime = microtime(true) - $preparationsStartTime;

        $objectDistributionByNodesStartTime = microtime(true);
        // emulate hash generation and detect which nodes hashes hit
        self::writeLn("Distributing: objects started");
        for ($objectN = 1; $objectN <= $emulateObjects; $objectN++) {
            $hash = md5($hashObjectPrefix . $objectN);

            $node = $nodeManager->findNodeForHash($hash, $alg);

            $nodesStats[$node->getName()]++;
        }
        $objectsDistributionByNodesFinishTime = microtime(true) - $objectDistributionByNodesStartTime;

        // output stats
        static::writeLn(print_r([
            '$nodesStats (node name->objects count)' => $nodesStats,
            '$slotsCount' => $slotsCount,
            '$nodesCount' => $nodesCount,
            '$emulateObjects' => $emulateObjects,
            'min objects quantity per node' => min($nodesStats),
            'max objects quantity per node' => max($nodesStats),
            'memory_usage bytes' => number_format(memory_get_usage(true), 0, '.',' '),
            '$preparationsFinishTime' => $preparationsFinishTime,
            '$objectsDistributionByNodesFinishTime' => $objectsDistributionByNodesFinishTime,
        ], true));
    }

    public static function writeLn(string $msg = '')
    {
        echo (new DateTime())->format(DateTime::ATOM) . " $msg\n\n";
    }
}

Test::run(\App\NodesManager::SEARCH_ALGORITHM__BINARY);
