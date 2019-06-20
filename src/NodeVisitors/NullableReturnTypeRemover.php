<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\Node\Param;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\FunctionLike as FunctionLike;

class NullableReturnTypeRemover extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof FunctionLike) {
            return;
        }
        if ($node->returnType instanceof Node\NullableType) {
            $node->returnType = null;
        }
    }
}
