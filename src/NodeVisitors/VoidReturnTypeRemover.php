<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\FunctionLike;

class VoidReturnTypeRemover extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof FunctionLike) {
            return;
        }
        if ((string) $node->returnType !== "void") {
            return;
        }

        $node->returnType = null;
    }
}
