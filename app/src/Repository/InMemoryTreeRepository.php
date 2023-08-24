<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TreeNode;

class InMemoryTreeRepository implements TreeRepositoryInterface
{
    private array $rest = [];
    private array $root = [];

    public function save(string $id, TreeNode $data): bool
    {
        empty($data->parent) ? $this->addToRoot($id, $data) : $this->addToRest($id, $data);

        return true;
    }

    public function find(string $id): ?TreeNode
    {
        return $this->rest[$id] ?? $this->root[$id] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function findAllRoot(): array
    {
        return $this->root;
    }

    private function addToRoot(string $id, TreeNode $data): void
    {
        $this->root[$id] = $data;
    }

    private function addToRest(string $id, TreeNode $data): void
    {
        $this->rest[$id] = $data;
    }
}
