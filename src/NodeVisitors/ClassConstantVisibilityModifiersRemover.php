<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\ClassConst;

/**
 * Removes the class constant visibility modifiers (PHP 7.1)
 */
class ClassConstantVisibilityModifiersRemover extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!($node instanceof ClassConst)) {
            return;
        }

        $node->flags = 0; // Remove constant modifier
    }
}
