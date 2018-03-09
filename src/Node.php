<?php
namespace App;

class Node
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $slotCount;
    /**
     * @var array
     */
    protected $hashes = [];

    public function __construct(string $name, int $slotCount = 0)
    {
        $this->setName($name);
        $this->setSlotCount($slotCount);
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        if (empty($name)) {
            throw new \RuntimeException('Cannot be empty');
        }

        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param int $slotCount
     *
     * @return $this
     */
    public function setSlotCount(int $slotCount = 0)
    {
        if ($slotCount < 1) {
            throw new \RuntimeException('Cannot be LT 1');
        }
        $this->slotCount = $slotCount;

        $this->regenerateHashes();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlotCount()
    {
        if (!isset($this->slotCount) || $this->slotCount < 1) {
            throw new \RuntimeException('Cannot be LT 1');
        }

        return $this->slotCount;
    }

    /**
     * @return array
     */
    public function getHashes(): array
    {
        return $this->hashes;
    }

    /**
     * @return $this
     */
    protected function resetHashes()
    {
        $this->hashes = [];

        return $this;
    }

    protected function regenerateHashes()
    {
        $this->resetHashes();
        for ($i = 0; $i < $this->slotCount; $i++) {
            $this->addHash($this->generateHash($i));
        }

        return $this;
    }

    /**
     * @param string $hash
     *
     * @return $this
     */
    protected function addHash(string $hash)
    {
        if (isset($this->hashes[$hash])) {
            throw new \RuntimeException("Hash '$hash' exists");
        }
        $this->hashes[$hash] = $hash;

        return $this;
    }

    /**
     * @param int $slotCount
     *
     * @return string
     */
    protected function generateHash(int $slotCount)
    {
        return sha1($this->getName() . $slotCount);
    }
}
