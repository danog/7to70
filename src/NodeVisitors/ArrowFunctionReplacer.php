<?php

namespace danog\Php7to70\NodeVisitors;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

/*
 * Converts arrow functions into closures
 */

class ArrowFunctionReplacer extends NodeVisitorAbstract
{
    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Expr\ArrowFunction) {
            return;
        }
        return new Node\Expr\Closure([
            'stmts' => $node->getStmts(),
            'static' => $node->static,
            'byRef' => $node->byRef,
            'params' => $node->params,
            'returnType' => $node->returnType,
        ]);
    }
}
