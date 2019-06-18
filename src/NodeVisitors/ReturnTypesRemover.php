<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\FunctionLike;

class ReturnTypesRemover extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof FunctionLike) {
            return;
        }
        if (!$node->returnType instanceof Node\NullableType) {
            return;
        }
        $node->returnType = null;
    }
}
