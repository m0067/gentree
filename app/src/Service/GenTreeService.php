<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TreeNode;
use App\Enum\TypeEnum;
use App\Helper\BasicHelper;
use App\Repository\TreeRepositoryInterface;

class GenTreeService
{
    public function __construct(private TreeRepositoryInterface $repo)
    {
    }

    public function generate(string $inputFilePath, string $outputFilePath): bool
    {
        BasicHelper::printMemoryUsage('start');

        if (($handle = fopen($inputFilePath, "r")) !== false) {
            $isFirstLine = true;

            while (($row = fgetcsv($handle, 1000, ";")) !== false) {
                [$nodeName, $nodeType, $parentName, $relation] = $row;

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                if (!$this->repo->find($nodeName)) {
                    $node = new TreeNode($nodeName, $parentName ?: null);
                    $this->repo->save($nodeName, $node);
                } else {
                    $node = $this->repo->find($nodeName);
                }

                if ($parentName !== "") {
                    if ($tempNode = $this->repo->find($nodeName)) {
                        $tempNode->parent = $parentName;
                    }

                    $parentNode = $this->repo->find($parentName);
                    $parentNode->addChild($node);
                }

                if ($nodeType === TypeEnum::DIRECT_COMPONENTS->value) {
                    if (!$this->repo->find($relation)) {
                        $this->repo->save($relation, new TreeNode($relation, $parentName));
                    }

                    $node->relationNode = $this->repo->find($relation);
                }
            }

            fclose($handle);
        }

        $outputTree = [];

        foreach ($this->repo->findAllRoot() as $node) {
            $outputTree[] = $this::buildOutputTree($node);
        }

        BasicHelper::printMemoryUsage('end');

        file_put_contents($outputFilePath, BasicHelper::jsonEncode($outputTree));

        return true;
    }

    private function buildOutputTree(TreeNode $node, ?string $parent = null): TreeNode
    {
        $tempNode = $node;

        if ($parent) {
            $tempNode = clone $node;
            $tempNode->parent = $parent;
        }

        foreach ($node->getChildren() as $child) {
            $this::buildOutputTree($child);
        }

        if ($node->relationNode) {
            foreach ($node->relationNode->getChildren() as $child) {
                $tempNode->addChild($this::buildOutputTree($child, $node->itemName));
            }
        }

        return $tempNode;
    }
}