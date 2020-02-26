<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\Node\Stmt\Property as StmtProperty;
use PhpParser\NodeVisitorAbstract;

/**
 * Removes type specifiers for properties (PHP 7.4).
 */
class TypedPropertiesStripper extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!($node instanceof StmtProperty)) {
            return;
        }
        $node->type = null;
    }
}
