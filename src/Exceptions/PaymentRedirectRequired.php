<?php

namespace Entryshop\Shop\Exceptions;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PaymentRedirectRequired extends HttpException
{
    protected $redirectTo;

    public function __construct($redirectTo, $message = 'Redirect to payment gateway.')
    {
        parent::__construct($message);
        $this->redirectTo = $redirectTo;
    }

    public function redirectTo(Request $request)
    {
        return $this->redirectTo;
    }

}
