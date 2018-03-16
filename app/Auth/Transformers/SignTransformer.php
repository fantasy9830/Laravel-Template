<?php

namespace App\Auth\Transformers;

use League\Fractal\TransformerAbstract;

class SignTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($token): array
    {
        return [
            'token' => $token
        ];
    }
}
