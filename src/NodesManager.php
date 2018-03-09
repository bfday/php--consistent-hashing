<?php
namespace App;

class NodesManager
{
    const SEARCH_ALGORITHM__BRUTE  = 0;
    const SEARCH_ALGORITHM__BINARY = 1;

    /**
     * @var Node[] - CANNOT contain duplicates of nodes
     */
    protected $nodes = [];
    /**
     * @var Node[] - hash -> node - CAN contain duplicates of nodes
     */
    protected $hashesNodes = [];
    /**
     * @var bool - to optimize adding
     */
    protected $isHashesNodesSorted = false;

    /**
     * Supplementary structure to make binary-tree search
     * @var array
     */
    protected $supplementaryHashes = [];

    /**
     * @param Node $node
     *
     * @return $this
     */
    public function addNode(Node $node)
    {
        if (isset($this->nodes[$node->getName()])) {
            throw new \RuntimeException("Node with name '{$node->getName()}' exists");
        }

        $this->nodes[$node->getName()] = $node;
        // add corresponding hashes
        $this->addHashesNodesByNode($node);

        return $this;
    }

    /**
     * @param Node $node
     *
     * @return $this
     */
    public function removeNode(Node $node)
    {
        if (!isset($this->nodes[$node->getName()])) {
            throw new \RuntimeException("Node with name '{$node->getName()}' doesnt exists");
        }

        unset($this->nodes[$node->getName()]);

        // remove corresponding hashes
        $this->removeHashesNodesByNode($node);

        return $this;
    }

    public function removeNodeByName(string $name)
    {
        $node = $this->getNodeByName($name);

        $this->removeNode($node);

        return $this;
    }

    /**
     * @param string $hash
     * @param int    $algorithm - SEARCH_ALG__BINARY | SEARCH_ALG__BRUTE
     *
     * @return Node|mixed|null
     */
    public function findNodeForHash(string $hash, int $algorithm = self::SEARCH_ALGORITHM__BINARY)
    {
        switch ($algorithm) {
            case static::SEARCH_ALGORITHM__BRUTE:
                return $this->findNodeForHash_brute($hash);
                break;
            case static::SEARCH_ALGORITHM__BINARY:
                return $this->findNodeForHash_binary($hash);
                break;
            default:
                throw new \RuntimeException("Not existing algorithm for search. See class constants");
        }
    }

    /**
     * @param string $hash
     *
     * @return Node|mixed|null
     */
    public function findNodeForHash_brute(string $hash)
    {
        if (count($this->hashesNodes) <= 0) {
            return null;
        }
        // for productivity, but useless cause it's rare case
        if (count($this->hashesNodes) === 1) {
            return reset($this->hashesNodes);
        }

        foreach ($this->hashesNodes as $nodeHash => $node) {
            if ($hash < $nodeHash) {
                return $node;
            }
        }

        return reset($this->hashesNodes);
    }

    /**
     * @param string $hash
     *
     * @return Node|null
     */
    public function findNodeForHash_binary(string $hash)
    {
        if (count($this->hashesNodes) <= 0) {
            return null;
        }
        // for productivity, but useless cause it's rare case
        if (count($this->hashesNodes) === 1) {
            return reset($this->hashesNodes);
        }

        // do recursive binary-tree search in supplementaryHashes
        return $this->hashesNodes[$this->findNodeHashUsingBinaryDivision($hash)];
    }

    /**
     * @param string   $hash       - hash for which we are looking nodeHash
     * @param int|null $leftIndex  - do not set it manually
     * @param int|null $rightIndex - do not set it manually
     *
     * @return string
     */
    protected function findNodeHashUsingBinaryDivision(string $hash, int $leftIndex = null, int $rightIndex = null): string
    {
        if ($leftIndex === null) {
            $leftIndex = 0;
        }
        if ($rightIndex === null) {
            $rightIndex = count($this->supplementaryHashes);
        }

        if ($leftIndex >= $rightIndex) {
            if ($hash <= $this->getSupplementaryHashByIndex($leftIndex)) {
                return $this->getSupplementaryHashByIndex($leftIndex);
            }
        }

        // find central or left element
        $centralIndex = $leftIndex + intdiv($rightIndex - $leftIndex, 2);
        if ($hash <= $this->getSupplementaryHashByIndex($centralIndex)) {
            return $this->findNodeHashUsingBinaryDivision($hash, $leftIndex, $centralIndex);
        }
        return $this->findNodeHashUsingBinaryDivision($hash, $centralIndex + 1, $rightIndex);
    }

    /**
     * @param int $index
     *
     * @return string
     */
    public function getSupplementaryHashByIndex(int $index): string
    {
        if (!isset($this->supplementaryHashes[$index])) {
            throw new \RuntimeException("supplementaryHash with such index '$index' doesnt exist");
        }

        return $this->supplementaryHashes[$index];
    }

    protected function fillSupplementaryHashes()
    {
        $this->supplementaryHashes = array_keys($this->hashesNodes);

        return $this;
    }

    public function sortHashesNodes()
    {
        ksort($this->hashesNodes);
        // refill supplementaryHashes
        $this->fillSupplementaryHashes();
        $this->setIsHashesNodesSorted(true);

        return $this;
    }

    protected function getNodeByName(string $name): Node
    {
        if (!isset($this->nodes[$name])) {
            throw new \RuntimeException("Node with name '$name' doesnt exists");
        }

        return $this->nodes[$name];
    }

    protected function addHashesNodesByNode(Node $node)
    {
        foreach ($node->getHashes() as $hash) {
            if (isset($this->hashesNodes[$hash])) {
                throw new \RuntimeException("Hash '$hash' already exists");
            }
            $this->hashesNodes[$hash] = $node;
        }
        // sort hashesNodes after add (to keep consistency)
        $this->setIsHashesNodesSorted();

        return $this;
    }

    protected function removeHashesNodesByNode(Node $node)
    {
        foreach ($node->getHashes() as $hash) {
            if (!isset($this->hashesNodes[$hash])) {
                throw new \RuntimeException("Hash '$hash' doesnt exists (has been removed?)");
            }
            unset ($this->hashesNodes[$hash]);
        }
        // refill supplementaryHashes
        $this->fillSupplementaryHashes();

        return $this;
    }

    /**
     * @param bool $isHashesNodesSorted
     *
     * @return bool
     */
    protected function setIsHashesNodesSorted(bool $isHashesNodesSorted = false)
    {
        $this->isHashesNodesSorted = $isHashesNodesSorted;
        return true;
    }

    /**
     * @return bool
     */
    protected function isHashesNodesSorted(): bool
    {
        return $this->isHashesNodesSorted;
    }

    /**
     * Validates state of manager to make sure you can use it's interface (some kind of optimization)
     * ToDo: refactor, add function like (->startAddingNodes ->finishAddingNodes)
     */
    protected function validateState()
    {
        if (!$this->isHashesNodesSorted()) throw new \RuntimeException("Before use manager do final preparations by using ->sortHashesNodes()");

        return $this;
    }
}
