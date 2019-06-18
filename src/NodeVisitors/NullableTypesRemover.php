<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\Node\Param;
use PhpParser\NodeVisitorAbstract;

class NullableTypesRemover extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Param) {
            return;
        }

        if ($node->type instanceof Node\NullableType) {
            $node->type = $node->type->type;
            if (!$node->default) {
                $node->default = new Node\Expr\ConstFetch(
                    new Node\Name('null')
                );
            }
        }
    }
}
