<?php

declare(strict_types=1);

namespace App\Entity;

use JsonSerializable;

class TreeNode implements JsonSerializable
{
    private array $children = [];

    public function __construct(
        public string    $itemName,
        public ?string   $parent = null,
        public ?TreeNode $relationNode = null,
    )
    {
    }

    public function addChild(TreeNode $childNode): void
    {
        $key = $childNode->itemName . $childNode->parent;

        if (!isset($this->children[$key])) {
            $this->children[$key] = $childNode;
        }
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function jsonSerialize(): array
    {
        return [
            'itemName' => $this->itemName,
            'parent' => $this->parent,
            'children' => array_values($this->getChildren()),
        ];
    }
}
