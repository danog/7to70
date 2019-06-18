<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeVisitorAbstract;
use danog\Php7to70\Converter;
use danog\Php7to70\Exceptions\InvalidPhpCode;

class MultipleCatchReplacer extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\TryCatch) {
            return;
        }

        $catches = [];
        foreach ($node->catches as $catch) {
            if (count($catch->types) === 1) {
                $catches []= $catch;
            } else {
                foreach ($catch->types as $type) {
                    $ncatch = clone $catch;
                    $ncatch->types = [$type];
                    $catches []= $ncatch;
                }
            }
        }
        $node->catches = $catches;

        return $node;
    }
}
