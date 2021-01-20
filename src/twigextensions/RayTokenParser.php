<?php

namespace Spatie\CraftRay\twigextensions;

use Twig\Error\SyntaxError;
use Twig\Node\Node;
use Twig\Parser;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;
use Twig\TokenParser\TokenParserInterface;

class RayTokenParser extends AbstractTokenParser
{

    public function parse(Token $token)
    {
        $lineno = $token->getLine();

        $parser = $this->parser;
        $stream = $parser->getStream();

        $nodes = [
            'var' => $parser->getExpressionParser()->parseExpression(),
        ];

        $stream->expect(Token::BLOCK_END_TYPE);

        return new RayNode($nodes, [], $lineno, $this->getTag());
    }

    public function getTag()
    {
        return 'ray';
    }
}
